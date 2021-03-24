<?php
namespace AHT\Question\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $_postFactory;

    public function __construct(\AHT\Question\Model\QuestionFactory $postFactory)
    {
        $this->_postFactory = $postFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $data = [
            'name' => "cuong", 
            'email' => "cuong9x98@gmail.com",
            'question'      => "cuong",
            'answer'      => "ok",
        ];
        $post = $this->_postFactory->create();
        $post->addData($data)->save();
    }
}
?>