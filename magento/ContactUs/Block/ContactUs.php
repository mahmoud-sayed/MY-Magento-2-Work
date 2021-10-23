<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BestResponseMedia\ContactUs\Block;

use Magento\Framework\View\Element\Template;
use BestResponseMedia\ContactUs\Model\ResourceModel\Options\CollectionFactory;

class ContactUs extends Template
{

    public function __construct(Template\Context $context, array $data = [], CollectionFactory $collection)
    {
        parent::__construct($context, $data);
        $this->collection = $collection;
        $this->_isScopePrivate = true;
    }

    public function getFormAction()
    {
        return $this->getUrl('contact/index/post', ['_secure' => true]);
    }

    public function getContactCollection()
    {
        return $this->collection->create()->getItems();
    }
}
