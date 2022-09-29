<?php


namespace DanielV\Directory\Plugin;


use Magento\Checkout\Api\GuestPaymentInformationManagementInterface;
use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\PaymentInterface;

class GuestPaymentInformationManagement
{
    /**
     * @param GuestPaymentInformationManagementInterface $subject
     * @param $cartId
     * @param $email
     * @param PaymentInterface $paymentMethod
     * @param AddressInterface|null $billingAddress
     */
    public function beforeSavePaymentInformationAndPlaceOrder(
        GuestPaymentInformationManagementInterface $subject,
        $cartId,
        $email,
        PaymentInterface $paymentMethod,
        AddressInterface $billingAddress = null
    ) {
        if($billingAddress) {
            $customAttr = ['county'];
            foreach ($customAttr as $attr) {
                if (isset($billingAddress->getCustomAttribute($attr)->getValue()['value'])){
                    $billingAddress->setCustomAttribute($attr, $billingAddress->getCustomAttribute($attr)->getValue()['value']);
                }
            }
        }
    }
}
