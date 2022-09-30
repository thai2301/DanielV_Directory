<?php

namespace DanielV\Directory\Plugin;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Api\ShippingInformationManagementInterface;

class ShippingInformationManagement
{
    /**
     * @param ShippingInformationManagementInterface $subject
     * @param $cartId
     * @param ShippingInformationInterface $addressInformation
     * @return array
     */
    public function beforeSaveAddressInformation(
        ShippingInformationManagementInterface $subject,
                                               $cartId,
        ShippingInformationInterface           $addressInformation
    ) {
        $customAttr      = 'county';
        $addressShipping = $addressInformation->getShippingAddress();
        $county          = '';
        if ($addressShipping->getCustomAttribute($customAttr))
            $county = isset($addressShipping->getCustomAttribute($customAttr)->getValue()['value']) ? $addressShipping->getCustomAttribute($customAttr)->getValue()['value'] : '';
        $addressShipping->setCounty($county);
        $addressShipping->setCustomAttribute($customAttr, $county);

        return [$cartId, $addressInformation];
    }
}
