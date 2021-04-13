# OK. Tiếp theo là Helper 

- Helper có tác dụng chính là hỗ trợ các mode, controller, template làm việc bằng cách cung cấp các hàm cần thiết có trong Helper 
- Các bạn có thể lại helper từ core AbtractionHelper hoặc viết Helper riêng và kế thừa Helper Core 

## Ví dụ;
 - Ở đây mình sẽ tạo thêm 1 hàm nữa trong Controller có tên là Price.php và 1 file Data.php trong thư mục Helper:
 - Price.php
 ```
 <?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Catalog\Helper\Product;

/**
 * Edit CMS block action.
 */
class Price extends \Magento\Backend\App\Action implements HttpGetActionInterface
{
    protected $helper;
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'AHT_Question::index';
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
         \AHT\Question\Helper\Data $helperData
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->helperData = $helperData;
        parent::__construct($context);
    }
    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        // $resultPage->setActiveMenu('AHT_Question::question_pending')
        //     ->addBreadcrumb(__('Question'), __('Question'))
        //     ->addBreadcrumb(__('Question Pendings'), __('Question Pendings'));
        return $resultPage;
    }

    /**
     * Edit CMS block
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {  
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('product_id');
        $model = $this->_objectManager->create(\Magento\Catalog\Model\Product::class);
        $model->load($id); 
        echo $this->helperData->getPrice($model);
    }
}

 ```
 - Ở đây mình sẽ dùng Helper và echo ra giá sản phẩm dựa vào đối tượng model đã được tìm kiếm id.
 - Data.php

 ```
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
 ```
 - Kế thừa lại Helper\Product và custom lại hàm getPrice

 => Tạo thêm nút getPrice trong ActionQuestion.php

 ```
 'price' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_GET_PRICE,
                                [
                                    'product_id' => $item['product_id'],
                                ]
                            ),
                            'label' => __('Get price'),
                            '__disableTmpl' => true,
                        ],
 ```
- Trong đó, URL_PATH_GET_PRICE được khai báo hằng là const URL_PATH_GET_PRICE = 'question/question/price';

## Ok, bây giờ chúng ta sẽ test xem có trả về giá sản phẩm không bằng cách vào trang list question chọn Get price trong Action thì sẽ hiện thị ra giá sản phẩm.