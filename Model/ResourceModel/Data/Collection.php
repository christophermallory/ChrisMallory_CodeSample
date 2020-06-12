<?php

namespace ChrisMallory\CodeSample\Model\ResourceModel\Data;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package ChrisMallory\CodeSample\Model\ResourceModel\Data
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * @var string
     */
    protected $_eventPrefix = 'chrismallory_codesample_data_collection';
    /**
     * @var string
     */
    protected $_eventObject = 'data_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ChrisMallory\CodeSample\Model\Data', 'ChrisMallory\CodeSample\Model\ResourceModel\Data');
    }
}
