<?php
namespace AHT\Question\Api\Data;

interface QuestionInterface
{
    /**
    * Get post name
    *
    * @return string|null
    */

    public function getName();

    /**
    * Get post name
    *
    * @return string|null
    */

    public function getEmail();
    /**
    * Get post name
    *
    * @return string|null
    */

    public function getStatus();

    /**
    * Get post name
    *
    * @return string|null
    */

    public function getQuestion();

    /**
     * Get post name
     *
     * @return string|null
     */

    public function getStoreId();

    /**
    * Get post name
    *
    * @return string|null
    */

    public function getProductId();

    /**
    * Get post name
    *
    * @return string|null
    */

    public function getAnswer();

    /**
    * Get post name
    *
    * @return string|null
    */

    public function getCreatedAt();

    /**
    * Get post name
    *
    * @return string|null
    */

    public function getUpdatedAt();

    /**
    * Get post name
    *
    * @return string|null
    */

    public function getQuestionId();

    /**
    * Get post name
    *
    * @return string|null
    */

    public function setName($name);

    /**
    * Get post name
    *
    * @return string|null
    */

    public function setEmail($email);

    /**
    * Get post name
    *
    * @return string|null
    */

    public function setQuestion($question);

    /**
    * Get post name
    *
    * @return string|null
    */

    public function setAnswer($answer);

    /**
    * Get post name
    *
    * @return string|null
    */

    public function setProductId($productId);

  
    /**
    * Get post name
    *
    * @return string|null
    */

    public function setUserId($status);

    /**
    * Get post name
    *
    * @return string|null
    */

    public function setStatus($status);

    /**
     * Get post name
     *
     * @return string|null
     */

    public function setStoreId($store_id);

    /**
     * Get post name
     *
     * @return string|null
     */

    public function setCreatedAt($created_at);

    /**
        * Get post name
        *
        * @return string|null
        */

    public function setUpdatedAt($updated_at);

    
    /**
     * Get post name
     *
     * @return string|null
     */

    public function getUserId();
}
