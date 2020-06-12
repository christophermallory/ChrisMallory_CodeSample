<?php

namespace ChrisMallory\CodeSample\Block\Adminhtml\Block\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinueButton
 *
 * @package ChrisMallory\CodeSample\Block\Adminhtml\Block\Edit
 */
class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Get buttong attributes
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
