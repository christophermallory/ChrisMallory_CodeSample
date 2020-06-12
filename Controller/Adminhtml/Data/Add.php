<?php

namespace ChrisMallory\CodeSample\Controller\Adminhtml\Data;

use ChrisMallory\CodeSample\Controller\Adminhtml\Data;

/**
 * Class Add
 *
 * @package ChrisMallory\CodeSample\Controller\Adminhtml\Data
 */
class Add extends Data
{
    /**
     * Forward to edit
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
