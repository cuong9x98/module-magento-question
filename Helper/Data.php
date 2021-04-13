<?php
namespace AHT\Question\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends \Magento\Catalog\Helper\Product
{
    protected $_customerSession;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_customerSession = $customerSession;
    }

    public function getCustomerSession() {
        return $this->_customerSession;
    }
     /**
     * Retrieve product price
     *
     * @param ModelProduct $product
     * @return float
     */
    public function getPrice($product)
    {
        return $product->getPrice()*2;
    }
}