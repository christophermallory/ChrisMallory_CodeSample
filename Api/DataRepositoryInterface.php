<?php

namespace ChrisMallory\CodeSample\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use ChrisMallory\CodeSample\Api\Data\DataInterface;

/**
 * Interface DataRepositoryInterface
 *
 * @package ChrisMallory\CodeSample\Api
 */
interface DataRepositoryInterface
{

    /**
     * @param DataInterface $data
     * @return mixed
     */
    public function save(DataInterface $data);


    /**
     * @param $entityId
     * @return mixed
     */
    public function getById($entityId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \ChrisMallory\CodeSample\Api\Data\DataSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param DataInterface $data
     * @return mixed
     */
    public function delete(DataInterface $data);

    /**
     * @param $entityId
     * @return mixed
     */
    public function deleteById($entityId);
}
