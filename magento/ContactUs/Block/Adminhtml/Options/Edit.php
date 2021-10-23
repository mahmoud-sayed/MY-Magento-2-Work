<?php
namespace BestResponseMedia\ContactUs\Block\Adminhtml\Options;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Option edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'option_id';
        $this->_blockGroup = 'BestResponseMedia_ContactUs';
        $this->_controller = 'adminhtml_options';

        parent::_construct();

        if ($this->_isAllowedAction('BestResponseMedia_ContactUs::options')) {
            $this->buttonList->update('save', 'label', __('Save Option'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');

    }

    /**
     * Get header with Option Value
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('contactus_option')->getId()) {
            return __("Edit Option '%1'", $this->escapeHtml($this->_coreRegistry->registry('contactus_option')->getOptionValue()));
        } else {
            return __('New Option');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

}
