<?php

namespace ChrisMallory\CodeSample\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface DataSearchResultsInterface
 *
 * @package ChrisMallory\CodeSample\Api\Data
 */
interface DataSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get data list.
     *
     * @return \ChrisMallory\CodeSample\Api\Data\DataInterface[]
     */
    public function getItems();

    /**
     * Set data list.
     *
     * @param \ChrisMallory\CodeSample\Api\Data\DataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
