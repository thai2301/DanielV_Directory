<?php

namespace DanielV\Directory\Plugin;

use Magento\Checkout\Api\PaymentInformationManagementInterface;
use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\PaymentInterface;

class PaymentInformationManagement
{
    /**
     * @param PaymentInformationManagementInterface $subject
     * @param $cartId
     * @param PaymentInterface $paymentMethod
     * @param AddressInterface|null $billingAddress
     */
    public function beforeSavePaymentInformationAndPlaceOrder(
        PaymentInformationManagementInterface $subject,
                                              $cartId,
        PaymentInterface                      $paymentMethod,
        AddressInterface                      $billingAddress = null
    ) {
        if ($billingAddress) {
            $customAttr = 'county';
            $county     = '';
            if ($billingAddress->getCustomAttribute($customAttr))
                $county = isset($billingAddress->getCustomAttribute($customAttr)->getValue()['value']) ? $billingAddress->getCustomAttribute($customAttr)->getValue()['value'] : '';
            $billingAddress->setCustomAttribute($customAttr, $county);
        }
    }
}
