<?php
namespace DanielV\Directory\Model\Plugin\Customer\Model;

use Magento\Customer\Api\Data\AddressInterface;

class Address
{
    public function afterUpdateData(\Magento\Customer\Model\Address $subject, $result, AddressInterface $address)
    {
       $data = $address->__toArray();
       if (isset($data['county'])) {
           $result->setCounty($data['county'] ?? '');
       }
       return $result;
    }
}
