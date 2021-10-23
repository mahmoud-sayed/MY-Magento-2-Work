<?php

namespace BestResponseMedia\ContactUs\Controller\Adminhtml\Options;

use BestResponseMedia\ContactUs\Controller\Adminhtml\Options\Options;

class Edit extends Index
{
    /**
     * @return void
     */
    public function execute()
    {
        $OptionsId = $this->getRequest()->getParam('option_id');
        $model = $this->_optionsFactory->create();

        if ($OptionsId) {
            $model->load($OptionsId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This options no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        // Restore previously entered form data from session
        // $data = $this->_session->getNewsData(true);
        // var_dump($data); exit;
        // if (!empty($data)) {
        //     $model->setData($data);
        // }
        $this->_coreRegistry->register('contactus_option', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('BestResponseMedia_ContactUs::options');
        $resultPage->getConfig()->getTitle()->prepend(__('Options'));

        return $resultPage;
    }
}
