<?php
/**
 * Copyright © 2020 DanielV. All rights reserved.
 * See COPYING.txt for license details.
 *
 * DanielV_Directory extension
 * NOTICE OF LICENSE
 *
 * @category DanielV
 * @package DanielV_Directory
 */

namespace DanielV\Directory\Plugin;


use Magento\Checkout\Api\Data\ShippingInformationInterface;

class GuestShippingInformationManagement
{
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Api\GuestShippingInformationManagementInterface $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        $customAttr = 'county';
        $addressShipping = $addressInformation->getShippingAddress();
            if(isset($addressShipping->getCustomAttribute($customAttr)->getValue()['value'])) {
                $addressShipping->setCounty($addressShipping->getCustomAttribute($customAttr)->getValue()['value']);
                $addressShipping->setCustomAttribute($customAttr, $addressShipping->getCustomAttribute($customAttr)->getValue()['value']);
            }
        return [$cartId, $addressInformation];
    }
}
