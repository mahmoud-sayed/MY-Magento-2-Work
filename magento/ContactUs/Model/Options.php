<?php
namespace BestResponseMedia\ContactUs\Model;


class Options extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'bestresponsemedia_contactus_options';
    protected $_cacheTag = 'bestresponsemedia_contactus_options';
    protected $_eventPrefix = 'bestresponsemedia_contactus_options';

    protected function _construct()
    {
        $this->_init('BestResponseMedia\ContactUs\Model\ResourceModel\Options');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
}
