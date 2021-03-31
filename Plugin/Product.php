<?php
namespace AHT\Question\Plugin;

class Product
{
   public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
   {
    return $result + 100;
   }
}