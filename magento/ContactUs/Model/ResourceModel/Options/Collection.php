<?php
namespace BestResponseMedia\ContactUs\Model\ResourceModel\Options;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'option_id';
    protected $_eventPrefix = 'bestresponsemedia_contactus_options_collection';
    protected $_eventObject = 'options_collection';

    protected function _construct()
    {
        $this->_init('BestResponseMedia\ContactUs\Model\Options', 'BestResponseMedia\ContactUs\Model\ResourceModel\Options');
    }
}