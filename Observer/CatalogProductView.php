<?php
namespace Sga\QuickView\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\App\RequestInterface;

class CatalogProductView implements ObserverInterface
{
    protected $_layout;
    protected $_request;

    public function __construct(
        LayoutInterface $layout,
        RequestInterface $request
    ){
        $this->_layout = $layout;
        $this->_request = $request;
    }

    public function execute(Observer $observer)
    {
        if ($this->_request->getParam('quickview')) {
            $this->_layout->getUpdate()->addHandle(['quickview']);
        }
    }
}
