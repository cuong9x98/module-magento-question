<?php

namespace AHT\Portfolio\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
	protected $_postFactory;

	public function __construct(\AHT\Portfolio\Model\PortfolioFactory $postFactory)
	{
		$this->_postFactory = $postFactory;
	}

	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		if (version_compare($context->getVersion(), '1.0.2', '<')) {
			$data = [
				'name'      => "cuong", 
				'email'     => "cuong9x98@gmail.com",
				'content'   => "cuong",
				'status'    => 0,
				'type'		=> 0,
				'time'		=> '12/02/2021',
				'product_id'=> 1256
			];
			$post = $this->_postFactory->create();
			$post->addData($data)->save();
		}
		$setup->startSetup();

        
	}
}