<?php

namespace ChrisMallory\CodeSample\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Exception\NoSuchEntityException;
use ChrisMallory\CodeSample\Api\DataRepositoryInterface;
use ChrisMallory\CodeSample\Api\Data\DataInterface;
use ChrisMallory\CodeSample\Api\Data\DataInterfaceFactory;
use ChrisMallory\CodeSample\Api\Data\DataSearchResultsInterfaceFactory;
use ChrisMallory\CodeSample\Model\ResourceModel\Data as ResourceData;
use ChrisMallory\CodeSample\Model\ResourceModel\Data\CollectionFactory as DataCollectionFactory;

/**
 * Class DataRepository
 *
 * @package ChrisMallory\CodeSample\Model
 */
class DataRepository implements DataRepositoryInterface
{
    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var ResourceData
     */
    protected $resource;

    /**
     * @var DataCollectionFactory
     */
    protected $dataCollectionFactory;

    /**
     * @var DataSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataInterfaceFactory
     */
    protected $dataInterfaceFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * DataRepository constructor.
     *
     * @param ResourceData                      $resource
     * @param DataCollectionFactory             $dataCollectionFactory
     * @param DataSearchResultsInterfaceFactory $dataSearchResultsInterfaceFactory
     * @param DataInterfaceFactory              $dataInterfaceFactory
     * @param DataObjectHelper                  $dataObjectHelper
     */
    public function __construct(
        ResourceData $resource,
        DataCollectionFactory $dataCollectionFactory,
        DataSearchResultsInterfaceFactory $dataSearchResultsInterfaceFactory,
        DataInterfaceFactory $dataInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->resource = $resource;
        $this->dataCollectionFactory = $dataCollectionFactory;
        $this->searchResultsFactory = $dataSearchResultsInterfaceFactory;
        $this->dataInterfaceFactory = $dataInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * @param DataInterface $data
     * @return DataInterface
     * @throws CouldNotSaveException
     */
    public function save(DataInterface $data)
    {
        try {
            /** @var DataInterface|\Magento\Framework\Model\AbstractModel $data */
            $this->resource->save($data);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the data: %1',
                $exception->getMessage()
            ));
        }
        return $data;
    }

    /**
     * Get data record
     *
     * @param $entityId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($entityId)
    {
        if (!isset($this->instances[$entityId])) {
            /** @var \ChrisMallory\CodeSample\Api\Data\DataInterface|\Magento\Framework\Model\AbstractModel $data */
            $data = $this->dataInterfaceFactory->create();
            $this->resource->load($data, $entityId);
            if (!$data->getEntityId()) {
                throw new NoSuchEntityException(__('Requested data doesn\'t exist'));
            }
            $this->instances[$entityId] = $data;
        }
        return $this->instances[$entityId];
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \ChrisMallory\CodeSample\Api\Data\DataSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \ChrisMallory\CodeSample\Api\Data\DataSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /** @var \ChrisMallory\CodeSample\Model\ResourceModel\Data\Collection $collection */
        $collection = $this->dataCollectionFactory->create();

        //Add filters from root filter group to the collection
        /** @var FilterGroup $group */
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
        $sortOrders = $searchCriteria->getSortOrders();
        /** @var SortOrder $sortOrder */
        if ($sortOrders) {
            foreach ($searchCriteria->getSortOrders() as $sortOrder) {
                $field = $sortOrder->getField();
                $collection->addOrder(
                    $field,
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        } else {
            $field = 'entity_id';
            $collection->addOrder($field, 'ASC');
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $data = [];
        foreach ($collection as $datum) {
            $dataDataObject = $this->dataInterfaceFactory->create();
            $this->dataObjectHelper->populateWithArray($dataDataObject, $datum->getData(), DataInterface::class);
            $data[] = $dataDataObject;
        }
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->setItems($data);
    }

    /**
     * @param DataInterface $data
     * @return bool
     * @throws CouldNotSaveException
     * @throws StateException
     */
    public function delete(DataInterface $data)
    {
        /** @var \ChrisMallory\CodeSample\Api\Data\DataInterface|\Magento\Framework\Model\AbstractModel $data */
        $id = $data->getEntityId();
        try {
            unset($this->instances[$id]);
            $this->resource->delete($data);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove data %1', $id)
            );
        }
        unset($this->instances[$id]);
        return true;
    }

    /**
     * @param $entityId
     * @return bool
     */
    public function deleteById($entityId)
    {
        $data = $this->getById($entityId);
        return $this->delete($data);
    }
}
