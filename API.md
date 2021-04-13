# Ok.API 

- Như các bạ đã biết thì trong 1 hệ thống thì cần có API để giao tiếp với các hệ thống khác 
- Api sinh ra để phục vụ cho việc các hệ thống khác được sử dụng tài nguyên của mình nhưng phải theo quy tắc và hạn chế do chúng ta tạo ra.

## 1.Tạo 2 file QuestionRepositoryInterface.php(Api) và QuestionInterface.php(Api/Data) 
- Đây là 2 file cơ sở của Api trong đó QuestionInterface.php có nhiệm vụ quy định nhưng phương thức trong model khi bất kì 1 class nào implements nó. Tương tự, QuestionRepositoryInterface.php nó sẽ quy định các phương thức thực hiện trong Api vd: get,getlist,update,delete... Các bạn nhìn kĩ thì 2 file này có nét giống với Model mà chúng ta tạo ra. 
=> 2 file trên có thể hiểu là base các quy định của Api.

## 2.Tạo file QuestionRepository.php và tạo  implements .
- Ok, đến đây các bạn sẽ hiểu rõ hơn file Question.php (Model) sẽ implements vào file QuestionInterface.php còn file QuestionRepository.php sẽ implements đến QuestionRepositoryInterface.php 
```
<?php
namespace AHT\Question\Model;

use AHT\Question\Model\QuestionFactory;
use AHT\Question\Model\ResourceModel\Question;
use AHT\Question\Api\Data\QuestionInterface;
use AHT\Question\Model\ResourceModel\Question as Resource;

class QuestionRepository implements \AHT\Question\Api\QuestionRepositoryInterface {

    protected $resource;
    protected $_questionFactory;
    protected $_questionResource;
    protected $_request;
    public function __construct(
        Resource  $resource,
        QuestionFactory $questionFactory,
        Question $questionResource,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->resource = $resource;
        $this->_questionFactory = $questionFactory;
        $this->_questionResource = $questionResource;
        $this->_request = $request;
    }
   
    /**
     * Undocumented function
     *
     * @param [type] $qaId
     * @return void
     */
    public function get($qaId) {
        $id = (int) $qaId;
        $model = $this->_questionFactory->create();
        $this->_questionResource->load($model, $id);
        return $model->getData();
    }

    /**
     * Undocumented function
     *
     * @return null
     */
    public function getList() {
        // die('hoho');
        $collection = $this->_questionFactory->create()->getCollection();
        return $collection->getData();
    }

    /**
     * Save Block data
     *
     * 
     * @return \AHT\Question\Model\Question
     */
    public function save(QuestionInterface $qa) {
        $this->_questionResource->save($qa);
        return $qa->getData();
    }


    public function updatePost(String $id, QuestionInterface $post)
    {
            $question_id = (int) $id;
            $model = $this->_questionFactory->create();
            $this->_questionResource->load($model, $question_id);
            $model->setData($post->getData());
            $model->setId($question_id);
            $this->_questionResource->save($model);

            return $model->getData();
    }

    public function deleteById($postId)
    {
        $id = (int) $postId;
        $model = $this->_questionFactory->create();
        $this->resource->load($model, $id);
        $model->delete();
        return true;
    }
}
```

- Trong đây sẽ viết các xử lí các phương thức mà chúng ta quy định ở Interface 

=> Các bạn vào trong file di.xml chèn thêm 
```
<!-- API -->
    <preference for="AHT\Question\Api\QuestionRepositoryInterface" type="AHT\Question\Model\QuestionRepository" />
    <preference for="AHT\Question\Api\Data\QuestionInterface" type="AHT\Question\Model\Question" />
```
 - Để ghi đè 2 file . Đến đây hơi trừu tượng tí, các bạn  tượng là 2 file interface ở trên sẽ có các chức năng như 2 file trong model đã implements nó => lúc đó Api đã có model để get data.

### 3.Tạo file webapi.xml 
 - Ok, đến đây việc cuối cùng của mình là tạo file webapi.xml để khai báo ra các router cho các hệ thống khác vào lấy.
 ```
<?xml version="1.0"?>
<!--
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
-->
<routes xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Webapi:etc/webapi.xsd">

    <!-- Product Service -->
    <route url="/V1/question/:qaId" method="GET">
        <service class="AHT\Question\Api\QuestionRepositoryInterface" method="get"/>
        <resources>
            <resource ref="anonymous" />
        </resources>
    </route>
    <route url="/V1/questions" method="GET">
        <service class="AHT\Question\Api\QuestionRepositoryInterface" method="getList"/>
        <resources>
            <resource ref="anonymous" />
        </resources>
    </route>

    <route url="/V1/saveQuestion" method="POST">
        <service class="AHT\Question\Api\QuestionRepositoryInterface" method="save"/>
        <resources>
            <resource ref="anonymous" />
        </resources>
    </route>
    
   <route url="/V1/updateQuestion/:qaId" method="PUT">
        <service class="AHT\Question\Api\QuestionRepositoryInterface" method="updatePost"/>
        <resources>
            <resource ref="anonymous"/>
        </resources>
    </route>

    <route  url="/V1/deleteQuestion/:postId" method="DELETE">
        <service class="AHT\Question\Api\QuestionRepositoryInterface" method="deleteById"/>
        <resources>
            <resource ref="anonymous"/>
        </resources>
    </route>


</routes>
 ``` 
 
