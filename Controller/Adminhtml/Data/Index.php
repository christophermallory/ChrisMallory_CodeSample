<?php

namespace ChrisMallory\CodeSample\Controller\Adminhtml\Data;

use ChrisMallory\CodeSample\Controller\Adminhtml\Data;

/**
 * Class Index
 *
 * @package ChrisMallory\CodeSample\Controller\Adminhtml\Data
 */
class Index extends Data
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set('Code Sample Additional Product Text');

        return $resultPage;
    }
}
