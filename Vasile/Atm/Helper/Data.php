<?php

namespace Vasile\Atm\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     *
     */
    const XML_ATM_BILLS = 'atm_configuration/bills/bills';
    const XML_ATM_STATUS = 'atm_configuration/bills/active';

    /**
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    public function getBills($storeId = null)
    {
        return explode(';',$this->getConfigValue(self::XML_ATM_BILLS, $storeId));
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    public function getStatus($storeId = null)
    {
        return $this->getConfigValue(self::XML_ATM_STATUS, $storeId);
    }

}