<?php

namespace ChrisMallory\CodeSample\Controller\Adminhtml\Data;

use ChrisMallory\CodeSample\Controller\Adminhtml\Data;

/**
 * Class Edit
 *
 * @package ChrisMallory\CodeSample\Controller\Adminhtml\Data
 */
class Edit extends Data
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $entityId = $this->getRequest()->getParam('entity_id');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('ChrisMallory_CodeSample::data')
            ->addBreadcrumb(__('Data'), __('Data'))
            ->addBreadcrumb(__('Manage Data'), __('Manage Data'));

        if ($entityId === null) {
            $resultPage->addBreadcrumb(__('New Entry'), __('New Entry'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Entry'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Entry'), __('Edit Entry'));
            $resultPage->getConfig()->getTitle()->prepend(
                $this->dataRepository->getById($entityId)->getDataTitle()
            );
        }
        return $resultPage;
    }
}
