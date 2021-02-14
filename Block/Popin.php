<?php
namespace Sga\QuickView\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Sga\QuickView\Helper\Config as ConfigHelper;

class Popin extends Template
{
    protected $_configHelper;

    public function __construct(
        Context $context,
        ConfigHelper $configHelper,
        array $data = []
    ) {
        $this->_configHelper = $configHelper;

        parent::__construct($context, $data);
    }

    public function isEnable()
    {
        return $this->_configHelper->isEnabled();
    }
}
