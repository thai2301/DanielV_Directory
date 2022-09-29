<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace DanielV\Directory\Model\Plugin\Quote;

use Magento\Framework\Registry;

/**
 * Class Address
 *
 * @package DanielV\Directory\Model\Plugin\Quote
 */
class Address
{
    /** @const */
    const CUSTOM_ATTRIBUTE_KEY = 'danielv_directory_quote_address_custom_attributes';
    const ESTIMATING_KEY       = 'estimating_key';
    const REQUESTING_TOTAL_KEY = 'requesting_total_key';

    /**
     * @var Registry
     */
    protected $_registry;

    /**
     * Constructor.
     *
     * @param Registry $registry
     */
    function __construct(
        Registry $registry
    ) {
        $this->_registry = $registry;
    }

    /**
     * Before export customer address
     *
     * @param \Magento\Quote\Model\Quote\Address $subject
     * @return array
     */
    public function beforeExportCustomerAddress(\Magento\Quote\Model\Quote\Address $subject)
    {
        foreach ($subject->getCustomAttributes() as $customAttribute) {
            $subject->setData($customAttribute->getAttributeCode(), $customAttribute->getValue());
        }

        return [];
    }

    /**
     * Before add data
     *
     * @param \Magento\Quote\Model\Quote\Address $subject
     * @param array $arr
     * @return array
     */
    public function beforeAddData(\Magento\Quote\Model\Quote\Address $subject, array $arr)
    {
        if (
            'billing' == $subject->getAddressType()
            || (isset($arr['address_type']) && 'billing' == $arr['address_type'])
            || $this->_registry->registry(self::ESTIMATING_KEY)
            || $this->_registry->registry(self::REQUESTING_TOTAL_KEY)
        ) {
            return [$arr];
        }

        if (isset($arr['county'])) {
            $this->_registry->unregister(self::CUSTOM_ATTRIBUTE_KEY);
            $this->_registry->register(self::CUSTOM_ATTRIBUTE_KEY, [
                ['attribute_code' => 'county', 'value' => $arr['county']]
            ]);
            return [$arr];
        }

        if (isset($arr['custom_attributes'])) {
            $this->_registry->unregister(self::CUSTOM_ATTRIBUTE_KEY);
            $this->_registry->register(self::CUSTOM_ATTRIBUTE_KEY, $arr['custom_attributes']);
            $this->_registry->register(self::ESTIMATING_KEY, true);
            if (isset($arr["custom_attributes"][0]) && $arr["custom_attributes"][0]['attribute_code'] == 'county'){
                $arr['county']= is_array($arr["custom_attributes"][0]["value"])? $arr["custom_attributes"][0]["value"][1]: $arr["custom_attributes"][0]["value"];
                unset($arr["custom_attributes"][0]);
            }
            return [$arr];
        }
        if (isset($arr['extension_attributes']) && !empty($arr['extension_attributes']->__toArray())) {
            //Todo request total
            $addressExtension = $arr['extension_attributes']->__toArray();
            if (isset($addressExtension['advanced_conditions']) && $addressExtension['advanced_conditions']) {
                $this->_registry->unregister(self::CUSTOM_ATTRIBUTE_KEY);
                $this->_registry->register(self::CUSTOM_ATTRIBUTE_KEY, $arr['extension_attributes']->getAdvancedConditions()->getCustomAttributes());
                $this->_registry->register(self::REQUESTING_TOTAL_KEY, true);
            }
            return [$arr];
        }

        return [$arr];
    }
}
