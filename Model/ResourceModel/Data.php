<?php

namespace ChrisMallory\CodeSample\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Data
 *
 * @package ChrisMallory\CodeSample\Model\ResourceModel
 */
class Data extends AbstractDb
{
    /**
     * Data constructor.
     *
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Resource initialisation
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init('chrismallory_code_sample', 'entity_id');
    }
}
