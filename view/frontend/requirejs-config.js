/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/model/new-customer-address': {
                'DanielV_Directory/js/model/new-customer-address-mixin': true
            },
            'Magento_Checkout/js/model/cart/cache': {
                'DanielV_Directory/js/model/cart/cache-mixin': true
            },
            'Magento_Checkout/js/model/address-converter': {
                'DanielV_Directory/js/model/address-converter-mixin': true
            },
            'Magento_Checkout/js/checkout-data': {
                'DanielV_Directory/js/checkout-data-mixin': true
            }
        }
    },
    map: {
        '*': {
            'Magento_Customer/js/model/customer-addresses': 'DanielV_Directory/js/model/customer-addresses',
            'Magento_Checkout/js/view/shipping-address/address-renderer/default': 'DanielV_Directory/js/view/shipping-address/address-renderer/default',
            'Magento_Checkout/js/view/shipping-information/address-renderer/default': 'DanielV_Directory/js/view/shipping-information/address-renderer/default',
            'Magento_Checkout/js/view/billing-address': 'DanielV_Directory/js/view/billing-address',
            'Magento_Checkout/js/model/shipping-rates-validation-rules': 'DanielV_Directory/js/model/shipping-rates-validator-rules-mixin'
        }
    }
};
