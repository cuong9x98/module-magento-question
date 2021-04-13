# Mode 

## Ok chúng ta đến với phần mode các bạn phải chú ý phần này vì nó rất quan trọng.

-  Nếu các bạn đã có source code của mình rồi thì các bạn thấy trong mode có rất nhiều file thì bạn chỉ cần chú ý giúp mình 4 file này thôi đây là 4 file quan trọng cấu thành mode :
    + Mode/Question.php : Đây là file chúng ta đều biết là class data nó chứa các hàm contructor đến Resource Module, chứa các hàm get set các thuộc tính.
    + Mode/ResourceModeQuestion/Question.php : 
        - Đây là file bạn sẽ xác định table mà mình làm việc xác định khóa chính rất giống với phần các bạn làm trong MVC đúng chứ.
        - file Model/Question.php sẽ làm việc với Db thông qua file Resource Model nó sẽ gọi đến Model/ResourceModel/Question.php
        - Model/ResourceModel/Question.php gọi phương thức truyền 2 đối số tên bảng và khóa chính, không thực hiện bất kì truy vấn nào. Nó extend đến AbstractDb có chứa các CRUD
    + Mode/ResourceModeQuestion/Question/Collection.php : Vậy còn file Model/ResourceModel/Question/Grid/Collection.php dùng để làm gì. Các bạn để ý lớp Collection kế thừa từ UI/Component nên nó sẽ được sử dụng cho UI/Component. Ở đây, do giao diện của mình sử dụng ui/component nên để giao diện có thể hiểu dữ liệu đổ vào giao diện thì bạn phải có file Collection hỗ trợ cho việc đổ dữ liệu vào giao diện. Các có thể thấy trong file di.xml chúng ta phải 'tiêm' Collection để giao diện có thể hiểu.
    + Mode/ResourceModeQuestion/Question/Grid/Collection.php : nếu bạn sử dụng ui/component thì bạn phải sử dụng nó vì nó có tác dụng giao tiếp giữa dữ liệu và giao diện ui/compinent. Các bạn sẽ thấy nó extend đến \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult.
- Các file trong Mode/Question chỉ là các file liên quan status trong ui/component và DataProvider file hỗ trợ đổ dữ liệu.
- Riêng file QuestionReponsive.php thì nó thuộc API thì ở phần API mình sẽ nói.



## 1.Question.php(Module)
```
<?php
namespace AHT\Question\Model;

use \AHT\Question\Api\Data\QuestionInterface;

class Question extends \Magento\Framework\Model\AbstractModel implements \AHT\Question\Api\Data\QuestionInterface
{

    /**
     * Undocumented function
     *
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource=null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection=null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    /**
     * @return void
     */
    
	public function _construct()
	{
		$this->_init('AHT\Question\Model\ResourceModel\Question');
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName() {
        return $this->getData("name");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getEmail() {
        return $this->getData("email");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getQuestion() {
        return $this->getData("question");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getAnswer() {
        return $this->getData("answer");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getCreatedAt() {
        return $this->getData("created_at");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getUpdatedAt() {
        return $this->getData("updated_at");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getImagePath() {
        return $this->getData("image_path");
    }
    /**
     * Undocumented function
     *
     * @return int
     */
  
    /**
     * Undocumented function
     *
     * @return int
     */
    public function getStoreId() {
        return $this->getData("store_id");

    }
    /**
     * Undocumented function
     *
     * @return int
     */
    public function getProductId() {
        return $this->getData("product_id");
    }
    /**
     * Undocumented function
     *
     * @return int
     */
    public function getUserId() {
        return $this->getData("user_id");
    }
    /**
     * Undocumented function
     *
     * @param string $name
     * @return null
     */
    public function setId($id)
    {
        $this->setData('question_id', $id);
    }
    public function setName($name) {
        return $this->setData("name", $name);
    }
    /**
     * Undocumented function
     *
     * @param int
     * @return null
     */
    public function setProductId($productId) {
        return $this->setData("product_id", $productId);
    }
    /**
     * Undocumented function
     *
     * @param string $email
     * @return null
     */
    public function setEmail($email) {
        return $this->setData("email", $email);
    }
    /**
     * Undocumented function
     *
     * @param string $question
     * @return null
     */
    public function setQuestion($question) {
        return $this->setData("question", $question);

    }
    /**
     * Undocumented function
     *
     * @param string $answer
     * @return null
     */
    public function setAnswer($answer) {
        return $this->setData("answer", $answer);
    }
}
``` 
- Chú ý: 
    + file Question.php copy từ file core lên cụ thể là Page.php trong module cms chúng ta sẽ customer lại theo đúng data của chúng ta  

## 2.Tạo file Question.php (Model/ResourceModel)
```
<?php
namespace AHT\Question\Model\ResourceModel;

class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    protected function _construct() 
    {
        $this->_init('aht_question', 'question_id');
    }
}

```
- Chú ý:
    + file Question.php copy từ file Page.php trong ResourceModel trong module cms và chúng ta chỉ dùng phương thức contructor các phương thức còn lại chưa dùng đến và customer theo module của chúng ta.

## 3.Tạo file Collection.php (ModeResource/Grid/Collection.php)

```
<?php
namespace AHT\Question\Model\ResourceModel\Question\Grid;

use AHT\Question\Model\Question;
use Magento\Framework\Api;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Psr\Log\LoggerInterface as Logger;

// use Magento\Framework\Api\Search\SearchResultInterface;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
   /**
     * Value of seconds in one minute
     */
    const SECONDS_IN_MINUTE = 60;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    /**
     * @var Visitor
     */
    protected $visitorModel;

    /**
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param string $mainTable
     * @param string $resourceModel
     * @param Visitor $visitorModel
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,$mainTable,
        $resourceModel,
        Question $questionModel,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->date = $date;
        $this->questionModel = $questionModel;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }

    protected function _initSelect()
    {
         $this->getSelect()
            ->from(['main_table' => 'aht_question'])
            ->joinLeft('catalog_product_entity_varchar',
            'main_table.product_id = catalog_product_entity_varchar.entity_id AND catalog_product_entity_varchar.attribute_id = 73',
            [
                'catalog_product_entity_varchar.value'
            ]);          
        $this->addFilterToMap('id', 'main_table.id');
        return $this;
    }
}

```
## 4.Tạo file Collection.php (ModeResource/Collection.php)
```
<?php
namespace AHT\Question\Model\ResourceModel\Question;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'question_id';
    protected $_eventPrefix = 'aht_question_collection';
    protected $_eventObject = 'Question_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Question\Model\Question', 'AHT\Question\Model\ResourceModel\Question');
    }

}
```
## 5.Tạo file QuestionInterface.php (Api/Data)
```
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Api\Data;

/**
 * CMS block interface.
 * @api
 * @since 100.0.2
 */
interface QuestionInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    // const QUESTION_ID      = 'qa_id';
    // const NAME = "name";
    // const EMAIL         = 'email';
    // const QUESTION       = 'question';
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT   = 'updated_at';
    // const STATUS     = 'status';
    // const ANSWER       = 'answer';
    // const STORE_ID = 'store_id';
    // const USER_ID   = 'user_id';
    // const IMAGE_PATH     = 'image_path'; 
    // const PRODUCT_ID = "product_id";
    /**#@-*/
  
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getEmail();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getQuestion();
    /**
     * Undocumented function
     *
     * @return int
     */
    public function getProductId();
    /**
     * Undocumented function
     *
     * @return int
     */
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getAnswer();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getCreatedAt();
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getUpdatedAt();
    /**
     * Undocumented function
     *
     * @return string
     */
  
     /**
     * Set question id
     *
     * @param int $id
     * @return @this
     */
    public function setId($id);
    /**
     * Undocumented function
     *
     * @param string $name
     * @return null
     */
    public function setName($name);
    /**
     * Undocumented function
     *
     * @param string $email
     * @return null
     */
    public function setEmail($email);
    /**
     * Undocumented function
     *
     * @param string $question
     * @return null
     */
    public function setQuestion($question);
    /**
     * Undocumented function
     *
     * @param string $answer
     * @return null
     */
    public function setAnswer($answer);
    /**
     * Undocumented function
     *
     * @param int $productId
     * @return null
     */
    public function setProductId($productId);

}

```
- Chú ý : file này được lấy từ Api\Data\PageInterace.php của module cms và chúng ta sẽ customer lại theo data của chúng ta.

#### Các bạn lưu ý : Tạm thời chúng ta làm theo tư duy copy file nào mà trong file đó có phương thức mình cần mà phương thức đó gọi đến lớp khác thì chúng ta tiếp tục copy từ core lên . Ở đây mình cần InstallData.php nhưng để sử dụng được nó thì mình cần thêm các file module và riêng file trong Api thì chúng ta chưa cần đến các bạn có thể không thêm và sửa lại file InstallData.php (mình bỏ cái use và imple) nhưng mình sẽ vẫn cho vào vì kiểu gì cũng làm 




