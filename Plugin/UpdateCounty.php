<?php

namespace DanielV\Directory\Plugin;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Model\GuestCart\GuestShippingMethodManagement;

class UpdateCounty
{
    /**
     * @param GuestShippingMethodManagement $subject
     * @param mixed $cartId
     * @param AddressInterface $address
     * @return array
     */
    public function beforeEstimateByExtendedAddress(GuestShippingMethodManagement $subject, $cartId, AddressInterface $address): array
    {
        if (isset($address->getCounty()['value']))
            $address->setCounty($address->getCounty()['value']);
        return [$cartId, $address];
    }
}
