<?php
namespace Sga\QuickView\Plugin;

use Magento\Catalog\Controller\Product\View as Subject;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory as ResultJsonFactory;
use Magento\Framework\View\LayoutInterface;

class ControllerProductView
{
    protected $_request;
    protected $_resultJsonFactory;
    protected $_layout;

    public function __construct(
        RequestInterface $request,
        ResultJsonFactory $resultJsonFactory,
        LayoutInterface $layout
    ) {
        $this->_request = $request;
        $this->_resultJsonFactory = $resultJsonFactory;
        $this->_layout = $layout;
    }

    public function afterExecute(
        Subject $subject,
        $result
    ){
        if ($this->_request->isXmlHttpRequest() && (int)$this->_request->getParam('quickview') === 1) {
            $html = $this->_layout->renderElement('main.content');
            $result = [
                'html' => $html
            ];

            $result = $this->_resultJsonFactory->create()
                ->setHeader('Content-type', 'application/json', true)
                ->setData($result);
        }

        return $result;
    }
}
