<?php
namespace BestResponseMedia\Payment\Model\Payment;

use Exception;
use Magento\Checkout\Model\Session;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Api\ExtensionAttributesFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\HTTP\ZendClientFactory;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;
use Magento\Payment\Helper\Data;
use Magento\Payment\Model\Method\AbstractMethod;
use Magento\Payment\Model\Method\Logger as PaymentLogger;
use Magento\Quote\Model\Quote as QuoteAlias;
use Magento\Quote\Model\Quote\Item;
use Zend_Http_Client_Exception;


/** Class PaymentWeb @package BestResponseMedia\PaymentWeb\Model\Payment */
class Payment extends AbstractMethod
{

    protected $_code = "payment_gateway";

    /** Availability option @var bool */
    protected $_isGateway = true;

    /** Availability option @var bool */
    protected $_canOrder = true;

    /** Availability option @var bool */
    protected $_canAuthorize = true;

    /** Availability option @var bool */
    protected $_canCapture = true;

    /** Availability option @var bool */
    protected $_canCapturePartial = true;

    /** Availability option @var bool */
    protected $_canRefund = true;

    /** Availability option @var bool */
    protected $_canRefundInvoicePartial = true;

    /** Availability option @var bool */
    protected $_canVoid = true;

    /** Availability option @var bool */
    protected $_canUseInternal = false;

    /** Availability option @var bool */
    protected $_canUseCheckout = true;

    /** Availability option @var bool */
    protected $_canFetchTransactionInfo = true;

    /** Availability option @var bool */
    protected $_canReviewPayment = true;

    const GATEWAYS = [
        'live' => [
            'live' => true,
            'checkout' => 'https://pay.payment-web.com/checkout',
            'key' => 'https://api.payment-web.com/v1/key',
        ],
        'test' => [
            'live' => false,
            'checkout' => 'https://test-pay.payment-web.com/checkout',
            'key' => 'https://test-api.payment-web.com/v1/key',
        ],
        'local' => [
            'live' => false,
            'checkout' => 'https://pay.payment-web.test/checkout',
            'key' => 'https://api.payment-web.test/v1/key',
        ],
    ];

    /** @var Session */
    protected $_checkoutSession;

    /** @var UrlInterface */
    protected $_urlInterface;

    /** @var ZendClientFactory */
    protected $_httpClientFactory;

    /**
     * Payment constructor.
     * @param Context $context
     * @param Registry $registry
     * @param ExtensionAttributesFactory $extensionFactory
     * @param AttributeValueFactory $customAttributeFactory
     * @param Data $paymentData
     * @param ScopeConfigInterface $scopeConfig
     * @param PaymentLogger $logger
     * @param Session $checkoutSession
     * @param UrlInterface $urlInterface
     * @param ZendClientFactory $httpClientFactory
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     * @param DirectoryHelper|null $directory
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ExtensionAttributesFactory $extensionFactory,
        AttributeValueFactory $customAttributeFactory,
        Data $paymentData,
        ScopeConfigInterface $scopeConfig,
        PaymentLogger $logger,
        Session $checkoutSession,
        UrlInterface $urlInterface,
        ZendClientFactory $httpClientFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = [],
        DirectoryHelper $directory = null
    )
    {
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            $resource,
            $resourceCollection,
            $data,
            $directory
        );

        $this->_checkoutSession = $checkoutSession;
        $this->_urlInterface = $urlInterface;
        $this->_httpClientFactory = $httpClientFactory;
    }

    public function isActive($storeId = null)
    {
        return (bool)(int)$this->getConfigData('active', $storeId);
    }

    /** @return array
     * @throws Exception
     */
    public function createPayload()
    {
        /** @var QuoteAlias $quote */
        $quote = $this->_checkoutSession->getQuote();

        $billing = $quote->getBillingAddress();
        $delivery = $quote->getShippingAddress();

        $ret = [
            'merchant_id' => $this->getConfigData('merchant_id'),
            'public_key' => $this->getConfigData('public_key'),
            'callback_url' => $this->_urlInterface->getUrl('payment/redirect/callback'),
            'nonce' => bin2hex(random_bytes(16)),

            'order_id' => $quote->getId(),
            'amount' => (int)round($quote->getGrandTotal() * 100),
            'currency' => $quote->getQuoteCurrencyCode(),

            'billing_firstname' => $billing->getFirstname(),
            'billing_lastname' => $billing->getLastname(),
            'billing_address_1' => $billing->getStreetLine(1),
            'billing_address_2' => $billing->getStreetLine(2),
            'billing_city' => $billing->getCity(),
            'billing_state' => $billing->getRegion(),
            'billing_postcode' => $billing->getPostcode(),
            'billing_country' => $billing->getCountry(),
            'billing_phone' => $billing->getTelephone(),
            'billing_email' => $billing->getEmail(),

            'delivery_firstname' => $delivery ? $delivery->getFirstname() : '__unsupported',
            'delivery_lastname' => $delivery ? $delivery->getLastname() : '__unsupported',
            'delivery_address_1' => $delivery ? $delivery->getStreetLine(1) : '__unsupported',
            'delivery_address_2' => $delivery ? $delivery->getStreetLine(2) : '__unsupported',
            'delivery_city' => $delivery ? $delivery->getCity() : '__unsupported',
            'delivery_state' => $delivery ? $delivery->getRegion() : '__unsupported',
            'delivery_postcode' => $delivery ? $delivery->getPostcode() : '__unsupported',
            'delivery_country' => $delivery ? $delivery->getCountry() : '__unsupported',
            'delivery_phone' => $delivery ? $delivery->getTelephone() : '__unsupported',

            'items' => [],
        ];

        foreach ($quote->getAllVisibleItems() as $item) {
            /** @var Item $item */
            $productOptions = $item->getProductOption();

            if ($productOptions && isset($productOptions['attributes_info'])) {
                $options = [];

                foreach ($productOptions['attributes_info'] as $attribute) {
                    $options[] = $attribute['label'] . ': ' . $attribute['value'];
                }
                $options = '(' . implode(', ', $options) . ')';
            } else {
                $options = '';
            }

            $ret['items'][] = [
                'product' => trim($item->getName() . ' ' . $options),
                'quantity' => (int)$item->getQtyOrdered(),
                'amount' => (int)round($item->getPriceInclTax() * 100),
            ];
        }

        if ((float)$quote->getShippingAddress()->getDiscountAmount() < 0) {
            $ret['items'][] = [
                'product' => 'Discounts',
                'quantity' => 1,
                'amount' => (int)round($quote->getShippingAddress()->getDiscountAmount() * 100),
            ];
        }

        if ((float)$quote->getShippingAddress()->getShippingAmount() > 0) {
            $ret['items'][] = [
                'product' => 'Shipping',
                'quantity' => 1,
                'amount' => (int)round($quote->getShippingAddress()->getShippingAmount() * 100),
            ];
        }

        $this->logger->debug($ret);

        return $ret;
    }

    /**
     * @param $data
     * @return string
     * @throws Exception
     */
    public function encrypt($data)
    {
        $gatewayKey = base64_decode($this->getGatewayKey());
        $privateKey = base64_decode($this->getPrivateKey());

        $key = sodium_crypto_box_keypair_from_secretkey_and_publickey($privateKey, $gatewayKey);
        $nonce = random_bytes(SODIUM_CRYPTO_BOX_NONCEBYTES);
        return base64_encode($nonce . sodium_crypto_box(json_encode($data), $nonce, $key));
    }

    /**
     * @param $message
     * @return bool|false|mixed|string
     * @throws Zend_Http_Client_Exception
     */
    public function decrypt($message)
    {
        $gatewayKey = base64_decode($this->getGatewayKey());
        $privateKey = base64_decode($this->getPrivateKey());

        $key = sodium_crypto_box_keypair_from_secretkey_and_publickey($privateKey, $gatewayKey);
        $message = base64_decode($message);

        $nonce = mb_substr($message, 0, 24, '8bit');
        $cypherText = mb_substr($message, 24, null, '8bit');

        return sodium_crypto_box_open($cypherText, $nonce, $key);
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getConfigData('merchant_id');
    }

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->getConfigData('private_key');
    }

    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->getConfigData('public_key');
    }

    /**
     * @return mixed
     */
    public function getGatewayUrl()
    {
        return (!$this->getConfigData('test') ? self::GATEWAYS['live']['checkout'] : self::GATEWAYS['test']['checkout']);
    }

    /**
     * @return string
     * @throws Zend_Http_Client_Exception
     */
    public function getGatewayKey()
    {
        $url = (!$this->getConfigData('test') ? self::GATEWAYS['live']['key'] : self::GATEWAYS['test']['key']);

        $client = $this->_httpClientFactory->create();
        $client->setUri($url);
        $client->setConfig(['timeout' => 300]);

        $json = '';
        try {
            $response = $client->request();
            if ($response->isSuccessful()) {
                $json = $response->getBody();
            }
        } catch (Exception $e) {
            return '';
        }

        $json = json_decode($json, true);
        if (isset($json['data']['public'])) {
            return $json['data']['public'];
        }

        return '';
    }
}
