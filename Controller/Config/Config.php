<?php
 
namespace AHT\Question\Controller\Config;

use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Edit CMS block action.
 */
class Config extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    const ENABLE = "setting/post/enable";
    const DISPLAY_TEXT = "setting/post/display_text";
 
    protected $scopeConfig;
 
    public function __construct(
        Action\Context $context,
        ScopeConfigInterface  $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
 
    public function execute()
    {
        $enable = $this->scopeConfig->getValue(self::ENABLE, ScopeInterface::SCOPE_STORE);
        $displayText = $this->scopeConfig->getValue(self::DISPLAY_TEXT, ScopeInterface::SCOPE_STORE);
        echo $enable;
        echo "<br>";
        echo $displayText;
    }
}
