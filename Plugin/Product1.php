<?php
namespace AHT\Question\Plugin;

use Magento\Framework\Interception;

class Product1
{
   public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
   {
    return $result + 100;
   }
}