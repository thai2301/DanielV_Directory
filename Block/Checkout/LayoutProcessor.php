<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace DanielV\Directory\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use DanielV\Directory\Helper\Data;

/**
 * Class LayoutProcessor
 *
 * @package DanielV\Directory\Block\Checkout
 */
class LayoutProcessor implements LayoutProcessorInterface
{
    /**
     * @var Data
     */
    protected $_dataHelper;

    /**
     * Constructor.
     *
     * @param Data $dataHelper
     */
    public function __construct(
        Data $dataHelper
    ) {
        $this->_dataHelper = $dataHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function process($jsLayout)
    {
        $countyCode  = 'county';
        $customField = array(
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config'    =>
                array(
                    'customScope' => 'shippingAddress',
                    'template'    => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                ),
            'dataScope' => 'shippingAddress.county',
            'label'     => __('County'),
            'provider'  => 'checkoutProvider',
            'sortOrder' => '99',
            'visible'   => true,
        );

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$countyCode] = $customField;

        return $jsLayout;
    }
}
