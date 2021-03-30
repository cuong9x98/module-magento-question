<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Api;

/**
 * @api
 * @since 100.0.2
 */
interface QuestionRepositoryInterface
{
    /**
     * Undocumented function
     * @return null
     */

    public function getList();

   /**
     * Undocumented function
     *
     * @param string $qaId
     * @return null
     */
    public function get($qaId);

    /**
     * Undocumented function
     * 
     *
     * @return \AHT\Question\Model\Question
     */
    public function save(\AHT\Question\Api\Data\QuestionInterface $qa);


    /**
     * Update post
     *
     * @param String $id
     * @param \AHT\Question\Api\Data\QuestionInterface $post
     * 
     * @return null
     */
    public function updatePost(String $qaId, \AHT\Question\Api\Data\QuestionInterface $post);


      /**
     * Delete Question.
     *
     * @param \AHT\Question\Api\Data\CategoryInterface $delete
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */

     /**
     * Delete Post by ID.
     *
     * @param string $postId
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    public function deleteById($postId);
}