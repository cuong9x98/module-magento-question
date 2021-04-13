# Controler 
 - Do ở phần này mình làm qua khá lâu rồi, bản thân cũng không chắc các file nhỏ liên quan trong quá trình làm nên mình xin phép nói các chức năng Controller thôi - Các bạn có thể xem video của Phục để biết cách làm còn trong đây mình sẽ giải thích những gì mình biết.
 - Thì Controller có nhiệm vụ sẽ nhận các request và xử lí các yêu cầu trong Controller các bạn có thể sử dụng Block hay Helper để hỗ trợ xử lí 
 - Khi chúng ta tạo menu các action a/b/c thì magento sẽ cắt chuỗi tìm đến thư mục Controller/b/c tương ứng chạy vào đấy.
- Facetory là gì ?? Các bạn cứ hiểu nó là 1 bản nháp do Magento tự động tạo ra để chúng ta có thể làm việc với nó.

## 1.Index.php
 - Đây là file show ra list các câu hỏi:
 ```
 <?php
namespace AHT\Question\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends Action implements HttpGetActionInterface
{
    const MENU_ID = 'AHT_Question::index';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create(); // create page empty
        $resultPage->setActiveMenu(static::MENU_ID); //set active fon menu
        $resultPage->getConfig()->getTitle()->prepend(__('Question All')); // create title page 
        return $resultPage;
    }
}

 ```

 => Ở đây sẽ chạy vào hàm execute các dòng tiếp theo đã được mình comment lại.