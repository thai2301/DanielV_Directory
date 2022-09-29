<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace DanielV\Directory\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Cache\Type\Config;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Json\Helper\Data as JsonData;

/**
 * Class Data
 * @package DanielV\Directory\Helper
 */
class Data extends AbstractHelper
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var Config
     */
    protected $_configCacheType;

    /**
     * @var JsonData
     */
    protected $_jsonHelper;

    /**
     * @var \Magento\Customer\Model\Address
     */
    private $address;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param Config $configCacheType
     * @param JsonData $jsonHelper
     * @param \Magento\Customer\Model\Address $address
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        Config $configCacheType,
        JsonData $jsonHelper,
        \Magento\Customer\Model\Address $address
    )
    {
        parent::__construct($context);
        $this->_storeManager = $storeManager;
        $this->_configCacheType = $configCacheType;
        $this->_jsonHelper = $jsonHelper;
        $this->address = $address;
    }

    /**
     * @param $addressId
     * @return array|\Magento\Customer\Model\Address
     */
    public function getAddressById($addressId)
    {
        if (!$addressId) {
            return [];
        }
        return $this->address->load($addressId);
    }

    /**
     * Retrieve data
     *
     * @return array
     */
    public function getData()
    {
        $data = [];

        return $data;
    }
}
