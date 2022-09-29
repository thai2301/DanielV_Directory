/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define(['jquery', 'underscore', 'mage/utils/wrapper'], function ($, _, wrapper) {
    'use strict';

    return function (newCustomerAddress) {

        return wrapper.wrap(newCustomerAddress, function (originalAction, addressData) {
            if (!addressData.hasOwnProperty('custom_attributes') || !addressData['custom_attributes'].length) {
                addressData['custom_attributes'] = {};
            }
            if (addressData.hasOwnProperty('county')) {
                addressData['custom_attributes']['county'] = {
                    'attribute_code': 'county',
                    'value': addressData['county']
                };
            }

            return originalAction(addressData);
        });
    };
});
