<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace DanielV\Directory\Block\Cart;

use DanielV\Directory\Helper\Data;
use Magento\Checkout\Block\Checkout\AttributeMerger;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

/**
 * Class LayoutProcessor
 *
 * @package DanielV\Directory\Block\Cart
 */
class LayoutProcessor implements LayoutProcessorInterface
{
    /**
     * @var AttributeMerger
     */
    protected $_merger;

    /**
     * @var Data
     */
    protected $_dataHelper;

    /**
     * Constructor.
     *
     * @param AttributeMerger $merger
     * @param Data $dataHelper
     */
    public function __construct(
        AttributeMerger $merger,
        Data            $dataHelper
    ) {
        $this->_merger     = $merger;
        $this->_dataHelper = $dataHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function process($jsLayout)
    {
        $elements = [
            'county' => [
                'visible'     => true,
                'formElement' => 'input',
                'label'       => __('County'),
                'sortOrder'   => 113
            ],
            'city'   => [
                'visible'     => true,
                'formElement' => 'input',
                'label'       => __('City'),
                'sortOrder'   => 0
            ]
        ];

        if (isset($jsLayout['components']['block-summary']['children']['block-shipping']['children']
            ['address-fieldsets']['children'])
        ) {
            $fieldSetPointer = &$jsLayout['components']['block-summary']['children']['block-shipping']
            ['children']['address-fieldsets']['children'];
            $fieldSetPointer = $this->_merger->merge($elements, 'checkoutProvider', 'shippingAddress', $fieldSetPointer);
        }

        return $jsLayout;
    }
}
