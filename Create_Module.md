# Ok,Start create module
## 1. Create Module
### a.Create file registration.php (AHT/Question)
```
<?php
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'AHT_Question',
    __DIR__
);

```

### b.Create file module.xml(AHT/Question/etc)
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

## 2.Tạo nút click trong menu admin
### a.Tạo file menu.xml trong etc/adminhtml
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

### b.Tạo Database cho question.
- Tạo thư mục Setup và trong đó có 2 file : InstallSchema.php và InstallData.php

- InstallSchema.php:
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
         * Create table 'greeting_message'
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

- InstallData.php:
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

- Questio.php(Module)
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


