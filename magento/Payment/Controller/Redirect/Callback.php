<?php
namespace BestResponseMedia\Payment\Controller\Redirect;

use BestResponseMedia\Payment\Model\Payment\Payment;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Payment\Model\Method\Logger as PaymentLogger;
use Magento\Quote\Api\CartManagementInterface as CartManagementInterfaceAlias;
use Magento\Quote\Model\Quote as QuoteAlias;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Payment\Transaction;
use Magento\Sales\Model\Order\Payment\Transaction\BuilderInterface;
use Magento\Sales\Model\OrderRepository;

/**Class Callback @package BestResponseMedia\PaymentWeb\Controller\Pay */
class Callback extends \Magento\Framework\App\Action\Action
{
    /** @var Payment */
    protected $_payment;

    /** @var ResultFactory */
    protected $_resultRedirect;

    /** @var Session */
    protected $_checkoutSession;

    /** @var UrlInterface */
    protected $_urlInterface;

    /** @var ManagerInterface */
    protected $_messageManager;

    /** @var CartManagementInterfaceAlias */
    protected $_quoteManagement;

    /** @var PaymentLogger */
    protected $_logger;

    /** @var BuilderInterface */
    protected $_transactionBuilder;

    /** @var OrderRepository */
    protected $_orderRepository;

    /**
     * Constructor
     *
     * @param Context $context
     * @param ResultFactory $result
     * @param Payment $payment
     * @param Session $checkoutSession
     * @param UrlInterface $urlInterface
     * @param ManagerInterface $messageManager
     * @param CartManagementInterfaceAlias $quoteManagement
     * @param PaymentLogger $logger
     * @param BuilderInterface $transactionBuilder
     * @param OrderRepository $orderRepository
     */
    public function __construct(
        Context $context,
        ResultFactory $result,
        Payment $payment,
        Session $checkoutSession,
        UrlInterface $urlInterface,
        ManagerInterface $messageManager,
        CartManagementInterfaceAlias $quoteManagement,
        PaymentLogger $logger,
        BuilderInterface $transactionBuilder,
        OrderRepository $orderRepository
    )
    {
        parent::__construct($context);

        $this->_resultRedirect = $result;
        $this->_payment = $payment;
        $this->_checkoutSession = $checkoutSession;
        $this->_urlInterface = $urlInterface;
        $this->_messageManager = $messageManager;
        $this->_quoteManagement = $quoteManagement;
        $this->_logger = $logger;
        $this->_transactionBuilder = $transactionBuilder;
        $this->_orderRepository = $orderRepository;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirect->create(ResultFactory::TYPE_REDIRECT);

        $payload = $this->_payment->decrypt($this->getRequest()->getPost('payload'));
        $payload = @json_decode($payload, true);

        $this->_logger->debug($payload);

        /** @var QuoteAlias $quote */
        $quote = $this->_checkoutSession->getQuote();

        if (
            $payload['status'] == 'success' &&
            $quote->hasItems() &&
            !$quote->getHasError() &&
            $quote->getId() == $payload['order_id']
        ) {
            /** @var Order $order */
            $order = $this->_quoteManagement->submit($quote);

            $paymentCall = $order->getPayment();
            foreach ($payload as $name => $value) {
                if (is_object($value)) {
                    $value = (array)$value;
                    $value = json_encode($value);
                }
                $paymentCall->setTransactionAdditionalInfo($name, $value);
                $paymentCall->setAdditionalInformation($name, $value);

            }
            $formattedPrice = $order->getBaseCurrency()->formatTxt(
                $order->getGrandTotal()
            );

            /** @todo get transaction id from payload */
            $transactionId = md5($payload);

            $message = __('The authorized amount is %1.', $formattedPrice);
            $paymentCall->setLastTransId($transactionId);

            $data = [];
            foreach ($payload as $name) {
                $data[$name] = $paymentCall->getAdditionalInformation($name);
            }

            $trans = $this->_transactionBuilder;
            $transaction = $trans->setPayment($paymentCall)
                ->setOrder($order)
                ->setFailSafe(true)
                ->setTransactionId($transactionId)
                ->setAdditionalInformation(
                    [
                        Transaction::RAW_DETAILS => $data
                    ]
                )
                ->build(Transaction::TYPE_CAPTURE);
            $paymentCall->addTransactionCommentsToOrder(
                $transaction,
                $message
            );
            $paymentCall->setParentTransactionId($transactionId);
            $paymentCall->save();
            $this->_orderRepository->save($order);
            $transaction->save();

            $this->_checkoutSession->clearHelperData();

            $this->_checkoutSession
                ->setLastQuoteId($quote->getId())
                ->setLastSuccessQuoteId($quote->getId())
                ->setLastOrderId($order->getId())
                ->setLastRealOrderId($order->getIncrementId())
                ->setLastOrderStatus($order->getStatus());

            $resultRedirect->setUrl($this->_urlInterface->getUrl('checkout/onepage/success'));
        } else {
            $this->_messageManager->addErrorMessage(__('Payment Failed, Please Try again later'));
            $resultRedirect->setUrl($this->_urlInterface->getUrl('checkout/cart/index'));
        }

        return $resultRedirect;
    }
}

