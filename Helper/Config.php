<?php

namespace Sga\QuickView\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    const XML_PATH_ENABLED = 'sga_quickview/general/enabled';

    public function isEnabled($store = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }
}
