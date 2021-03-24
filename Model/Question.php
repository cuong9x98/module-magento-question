<?php
namespace AHT\Question\Model;

class Question extends \Magento\Framework\Model\AbstractModel {
    public function __construct(
   	 \Magento\Framework\Model\Context $context,
   	 \Magento\Framework\Registry $registry,
   	 \Magento\Framework\Model\ResourceModel\AbstractResource $resource =
   	 null,
   	 \Magento\Framework\Data\Collection\AbstractDb $resourceCollection =
   	 null,
   	 array $data = []
    ) {
   	 parent::__construct($context, $registry, $resource,$resourceCollection, $data);
    }
    
    public function _construct() {
		$this->_init('AHT\Question\Model\ResourceModel\Question');
    }
	public function getName()
    {
        return $this->getData("name");
    }

    public function getStatus()
    {
        return $this->getData("status");
    }

    public function getEmail()
    {
        return $this->getData("email");
    }

    public function getQuestion()
    {
        return $this->getData("question");
    }

    public function getAnswer()
    {
        return $this->getData("answer");
    }

    public function getCreatedAt()
    {
        return $this->getData("created_at");
    }

    public function getUpdatedAt()
    {
        return $this->getData("updated_at");
    }

    public function getStoreId()
    {
        return $this->getData("store_id");
    }

    public function getProductId()
    {
        return $this->getData("product_id");
    }

    public function getUserId()
    {
        return $this->getData("user_id");
    }

    public function setUserId($name)
    {
        return $this->setData("user_id", $name);
    }

    public function setName($name)
    {
        return $this->setData("name", $name);
    }

    public function setStoreId($name)
    {
        return $this->setData("store_id", $name);
    }

    public function setCreatedAt($created_at)
    {
        return $this->setData("created_at", $created_at);
    }

    public function setUpdatedAt($updated_at)
    {
        return $this->setData("updated_at", $updated_at);
    }

    public function setEmail($email)
    {
        return $this->setData("email", $email);
    }

    public function setProductId($productId)
    {
        return $this->setData("product_id", $productId);
    }

    public function setQuestion($question)
    {
        return $this->setData("question", $question);
    }

    public function setAnswer($answer)
    {
        return $this->setData("answer", $answer);
    }

    public function setStatus($status)
    {
        return $this->setData("status", $status);
    }
}