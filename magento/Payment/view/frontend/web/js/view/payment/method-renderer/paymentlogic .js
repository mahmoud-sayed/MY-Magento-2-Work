define([
        'Magento_Payment/js/view/payment/cc-form',
        'jquery',
        'Magento_Payment/js/model/credit-card-validation/validator'
    ],
    function ($, Component, url) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'BestResponseMedia_Payment/payment/form'
            },

            getCode: function() {
                return 'bestresponsemedia_payment';
            },

            isActive: function() {
                return true;
            },
            validate: function() {
                var $form = $('#' + this.getCode() + '-form');
                return $form.validation() && $form.validation('isValid');
            }

        });
    }
);
