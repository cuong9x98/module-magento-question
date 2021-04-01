# Ok,Start create module
## I. Create Module
### 1.Create file registration.php (AHT/Question)
```
<?php
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'AHT_Question',
    __DIR__
);

```

### 2.Create file module.xml(AHT/Question/etc)
```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="AHT_Question" setup_version="1.0.0">
   	 <sequence>
   		 <module name="Magento_Widget"/>
   	 </sequence>
    </module>
</config>

```
- Chạy setup:upgrade
=> Đăng kí với khai báo module

## II.Tạo nút click trong menu admin
### 1.Tạo file menu.xml trong etc/adminhtml
```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Backend:etc/menu.xsd">
	<menu>
		<add id="AHT_Question::question" title="Question" translate="Question" module="AHT_Question" sortOrder="50"   resource="AHT_Question::question"/>
		<add id="AHT_Question::index" title="Question" module="AHT_Question" parent="AHT_Question::question" action="question/question/index" resource="AHT_Question::index" sortOrder="55" />
	</menu>
</config>

```
- Chú ý: 
	+ Mình phải đặt file menu.xml trong etc/adminhtml để nó xuất hiện trong admin 
	+ add id là id của menu 
	+ title là tên nút.
	+ parent là khai báo cho biết thuộc trong khối nào để xác định vị trí
	+ softOrder là thứ tự ưu tiên 
	+ action là tạo ra hành động khi ta click vào thì url sẽ thay đổi.
=> Tại đây chúng ta đã tạo ra nút Question trong menu nhưng nút chưa được xử lí.

### 2.Tạo Database cho question.
- Tạo thư mục Setup và trong đó có 2 file : InstallSchema.php và InstallData.php

- 1.InstallSchema.php:
```
	<?php
/**
* Copyright © 2016 Magento. All rights reserved.
* See COPYING.txt for license details.
*/

namespace AHT\Question\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Create table 'aht_question'
        */
        $table = $setup->getConnection()
        ->newTable($setup->getTable('aht_question'))
        ->addColumn(
            'question_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'question ID'
        )
        ->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Name'
        )
        ->addColumn(
            'email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Email'
        )
        ->addColumn(
            'question',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            ['nullable' => false],
            'Question'
        )
        ->addColumn(
            'answer',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            ['nullable' => false],
            'Answre'
        )
        ->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '0'],
            'Status'
        )
        ->addColumn(
            'product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' =>false, 'default' => '-1'],
            'Product ID'
        )
        ->addColumn(
            'user_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' =>false, 'default' => '-1'],
            'User ID'
        )
        ->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' =>false, 'default' => '-1'],
            'Store ID'
        )
        ->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Created At'
        )
        ->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Updated At'
        )
        ->setComment('Question Table');
        $setup->getConnection()->createTable($table);
      }
}
```
=> Tạo bảng và các cột trong db
- SchemaSetupInterface là đối tượng cung cấp các chức năng tương tác với cơ sở dữ liệu.
- ModuleContextInterface có chứa phương thức getVesion trả về phiên bản hiện tại.

- 2.InstallData.php:
```
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
```
=> Tạo bản ghi đầu tiên 
- Sau đó chạy upgrade và di:compile và deploy và c:c
=> Lưu ý : 
	+ muốn chạy được thì đảm bảo module của bạn chưa được chạy
	+ Các bạn có thể thấy trong method contructor của InstallData có gọi ra lớp Model -> Chúng ta phải đi tạo file trong thư mục module 

- 3.Question.php(Module)
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

- 4. Tạo file Question.php (Model/ResourceModel)
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

- 5. Tạo file QuestionInterface.php (Api/Data)
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

#### Các bạn lưu ý : Tạm thời chúng ta làm theo tư duy copy file nào mà trong file đó có phương thức mình cần mà phương thức đó gọi đến lớp khác thì chúng ta tiếp tục copy từ core lên . Ở đây mình cần InstallData.php nhưng để sử dụng được nó thì mình cần thêm các file module và file trong thư mục API




