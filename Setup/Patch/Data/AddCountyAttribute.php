<?php
/**
 * Copyright © 2020 DanielV. All rights reserved.
 * See COPYING.txt for license details.
 *
 * DanielV_Kootoro extension
 * NOTICE OF LICENSE
 *
 * @category DanielV
 * @package DanielV_Kootoro
 */

namespace DanielV\Directory\Setup\Patch\Data;

use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpdateStreetMultilineCountPatch
 *
 * @package DanielV\Directory\Setup\Patch\Data
 */
class AddCountyAttribute implements \Magento\Framework\Setup\Patch\DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * AddCustomerUpdatedAtAttribute constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory     $customerSetupFactory
    ) {
        $this->moduleDataSetup      = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $attributeCode = 'county';
        $customerSetup->addAttribute('customer_address', $attributeCode, [
            'type'             => 'static',
            'label'            => 'County',
            'input'            => 'text',
            'position'         => 86,
            'visible'          => true,
            'required'          => false,
            'visible_on_front' => true,
            'user_defined'     => false,
            'backend_type'     => 'static',
            'system'           => false,
        ]);

        $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', $attributeCode);
        $attribute->setData(
            'used_in_forms',
            [
                'adminhtml_customer_address',
                'customer_address_edit',
                'customer_register_address'
            ]
        );
        $attribute->save();

    }
}
