<?php

namespace ChrisMallory\CodeSample\Controller\Adminhtml\Data;

use ChrisMallory\CodeSample\Model\Data;

/**
 * Class MassDelete
 *
 * @package ChrisMallory\CodeSample\Controller\Adminhtml\Data
 */
class MassDelete extends MassAction
{
    /**
     * @param Data $data
     * @return $this
     */
    protected function massAction(Data $data)
    {
        $this->dataRepository->delete($data);
        return $this;
    }
}
