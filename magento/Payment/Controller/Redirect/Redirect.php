<?php
namespace BestResponseMedia\Payment\Controller\Redirect;

use \Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use \Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;

class Redirect extends Action
{

    protected $_resultRedirectFactory;
    protected $_resultPageFactory;
    /**
     * Redirect constructor.
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     */
    public function __construct(Context $context, RedirectFactory $resultRedirectFactory, PageFactory $resultPageFactory)
    {
        $this->_resultRedirectFactory = $resultRedirectFactory;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_resultRedirectFactory->create();
        $resultPage = $this->_resultPageFactory->create();
        $blockInstance = $resultPage->getLayout()->createBlock('payment/redirect')->toHtml();
        return $blockInstance;
    }

}