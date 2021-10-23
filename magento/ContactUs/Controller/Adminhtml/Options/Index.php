<?php
namespace BestResponseMedia\ContactUs\Controller\Adminhtml\Options;

class Index extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_optionsFactory;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \BestResponseMedia\ContactUs\Model\OptionsFactory $optionsFactory,
        \Magento\Framework\Registry $registry
    )
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_optionsFactory = $optionsFactory;
        $this->_coreRegistry = $registry;
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Options')));

        return $resultPage;

    }
}
