<?php
namespace AHT\Question\Model;

use AHT\Question\Api\Data\QuestionInterface;
use AHT\Question\Model\ResourceModel\Question;

class QuestionRepository implements \AHT\Question\Api\QuestionRepositoryInterface
{
    protected $_questionFactory;
    protected $_questionResource;
    protected $_request;
    public function __construct(
        QuestionFactory $questionFactory,
        Question $questionResource,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->_questionFactory = $questionFactory;
        $this->_questionResource = $questionResource;
        $this->_request = $request;
    }

    /**
     * function get all data
     *
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    public function getList()
    {
        $collection = $this->_questionFactory->create()->getCollection();
        return $collection->getData();
    }

    /**
     * Undocumented function
     *
     * @param \AHT\Question\Api\Data\QuestionInterface $Post
     * @return \AHT\Question\Api\Data\QuestionInterface
     */

    public function save(QuestionInterface $question)
    {
        try {
            $this->_questionResource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $question->getData();
    }
}
