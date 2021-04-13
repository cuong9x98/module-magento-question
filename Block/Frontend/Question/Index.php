<?php
namespace AHT\Question\Block\Frontend\Question;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\View\Element\Template\Context;
use AHT\Question\Model\ResourceModel\Question\Grid\CollectionFactory;

class Index extends Template implements BlockInterface
{
	
	protected $_collection;
    public $_storeManager;
    public $_customerSession;

    public $_helperData;

    public function __construct(
        CollectionFactory $questionCollectionFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \AHT\Question\Helper\Data $helperData,  
        array $data = []

    )
    {
        parent::__construct($context, $data);
        $this->_customerSession = $customerSession;
        $this->_helperData = $helperData;
        $this->_collection =  $questionCollectionFactory->create();
    }

    public function getDataBlocks()
    {
        $question = $this->_collection;
        $items = $question->getItems();
        foreach($items as $item)
        { 
            $itemData = $item->getData();
            $this->_loadedData[$item->getId()] = $itemData;
        }
        return $this->_loadedData;
    }

    public function getStoreManager(){
        return $this->_storeManager;
    }
	
	
}