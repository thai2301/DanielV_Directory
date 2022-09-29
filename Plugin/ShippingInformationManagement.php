<?php


namespace DanielV\Directory\Plugin;


use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Api\ShippingInformationManagementInterface;
use Magento\Framework\Exception\StateException;

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
