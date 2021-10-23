<?php

namespace BestResponseMedia\Payment\Model\Source;

class PaymentAction
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'authorize',
                'label' => __('Authorize Only')],
            ['value' => 'authorize_capture',
                'label' => __('Authorize and Capture')],
        ];
    }
}
