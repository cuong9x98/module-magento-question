<?php
namespace AHT\Question\Block\Product;

class View extends \Magento\Framework\View\Element\Template
{
   /**
     * @var \AHT\Question\Helper\Data
   */
   protected $_dataHelper;

 /**
 * @param \Magento\Framework\View\Element\Template\Context $context
 * @param \AHT\Question\Helper\Data $dataHelper
 * @param array $data
 */
public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    \My\Module\Helper\Data $dataHelper,
    array $data = []
) {
    $this->_dataHelper = $dataHelper;
    parent::__construct($context, $data);
}

public function canShowBlock()
{
    return $this->_dataHelper->isModuleEnabled();
}
}