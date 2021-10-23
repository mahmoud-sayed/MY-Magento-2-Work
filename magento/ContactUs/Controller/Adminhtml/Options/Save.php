<?php
namespace BestResponseMedia\ContactUs\Controller\Adminhtml\Options;

use BestResponseMedia\ContactUs\Controller\Adminhtml\Options\Index;

class Save extends Index
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('BestResponseMedia_ContactUs::options');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $option = $this->_optionsFactory->create();
        $resourceModel = $option->getResource();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            $id = $this->getRequest()->getParam('option_id');
            if ($id) {
                $resourceModel->load($option, $id);
            }

            $option->setData($data);

            $this->_eventManager->dispatch(
                'option_prepare_save',
                ['option' => $option, 'request' => $this->getRequest()]
            );

            try {
                $resourceModel->save($option);
                $this->messageManager->addSuccessMessage(__('option saved successfully.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['option_id' => $option->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the option'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['option_id' => $this->getRequest()->getParam('option_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
