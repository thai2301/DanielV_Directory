<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace DanielV\Directory\Model\Plugin\Quote\Address;

/**
 * Class CustomAttributeList
 * @package DanielV\Directory\Model\Plugin\Quote\Address
 */
class CustomAttributeList
{
    protected $customerAddressResource;

    public function __construct(
        \Magento\Customer\Model\ResourceModel\Address $customerAddressResource
    ) {
        $this->customerAddressResource = $customerAddressResource;
    }

    /**
     * After get attributes
     *
     * @param \Magento\Quote\Model\Quote\Address\CustomAttributeList $subject
     * @param $result
     * @return array
     */
    public function afterGetAttributes(\Magento\Quote\Model\Quote\Address\CustomAttributeList $subject, $result)
    {
        return array_merge($result, [
            'county' => $this->customerAddressResource->getAttribute('county')
        ]);
    }
}
