<?php
namespace AHT\Question\Plugin;

use Magento\Framework\Interception;

class Product3
{
   public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
   {
    return $result + 300;
   }
}