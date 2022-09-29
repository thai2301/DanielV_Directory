/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'underscore',
    'mage/translate'
], function ($, _) {
    'use strict';

    return function (cache) {
        return _.extend(cache, {
            requiredFields: ['countryId', 'region', 'regionId', 'postcode', 'city', 'county']
        })
    };
});
