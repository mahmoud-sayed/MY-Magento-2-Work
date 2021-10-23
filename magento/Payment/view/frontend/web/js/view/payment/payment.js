define([
    'uiComponent',
    'Magento_Checkout/js/model/payment/renderer-list'
], function (Component, rendererList) {
    'use strict';
    rendererList.push({
        type: 'bestresponsemedia_payment',
        component: 'BestResponseMedia_Payment/js/view/payment/method-renderer/payment'
    });
    return Component.extend({});
});
