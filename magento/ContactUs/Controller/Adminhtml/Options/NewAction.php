<?php
namespace BestResponseMedia\ContactUs\Controller\Adminhtml\Options;
use Magento\Backend\App\Action;
use BestResponseMedia\ContactUs\Model\Option as Option;

class NewAction extends Action
{
    /**
     * Edit A Contact Page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Options'));
        $this->_view->renderLayout();

    }
}
