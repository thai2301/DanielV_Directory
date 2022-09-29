<?php


namespace DanielV\Directory\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Registry;

class SaveQuoteAddress implements ObserverInterface
{

    /**
     * @var Registry
     */
    private $registry;

    public function __construct(
        Registry $registry
    )
    {
        $this->registry = $registry;
    }

    public function execute(Observer $observer)
    {
        $address = $observer->getEvent()->getQuoteAddress();
        $data = $this->registry->registry('address_data');
        if (!empty($data)) {
            $address->addData($data);
        }
    }
}
