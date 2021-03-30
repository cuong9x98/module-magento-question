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