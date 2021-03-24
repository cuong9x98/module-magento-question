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