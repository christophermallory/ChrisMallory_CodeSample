<?php

namespace ChrisMallory\CodeSample\Model;

use Magento\Framework\Model\AbstractModel;
use ChrisMallory\CodeSample\Api\Data\DataInterface;

/**
 * Class Data
 *
 * @package ChrisMallory\CodeSample\Model
 */
class Data extends AbstractModel implements DataInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'chrismallory_codesample_data';

    /**
     * @var string
     */
    protected $_cacheTag = 'chrismallory_codesample_data';

    /**
     * @var string
     */
    protected $_eventPrefix = 'chrismallory_codesample_data';

    /**
     * Initialise resource model
     */
    protected function _construct()
    {
        $this->_init('ChrisMallory\CodeSample\Model\ResourceModel\Data');
    }

    /**
     * Get cache identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int|mixed|null
     */
    public function getEntityId()
    {
        return $this->getData(DataInterface::ENTITY_ID);
    }

    /**
     * @param int $id
     *
     * @return DataInterface|Data|AbstractModel
     */
    public function setEntityId($id)
    {
        return $this->setData(DataInterface::ENTITY_ID);
    }

    /**
     * Get product SKU
     *
     * @return string
     */
    public function getProductSku()
    {
        return $this->getData(DataInterface::PRODUCT_SKU);
    }

    /**
     * Set product SKU
     *
     * @param $sku
     * @return $this
     */
    public function setProductSku($sku)
    {
        return $this->setData(DataInterface::PRODUCT_SKU, $sku);
    }

    /**
     * Get additional text
     *
     * @return string
     */
    public function getAdditionalText()
    {
        return $this->getData(DataInterface::ADDITIONAL_TEXT);
    }

    /**
     * Set additional text
     *
     * @param $text
     * @return $this
     */
    public function setAdditionalText($text)
    {
        return $this->setData(DataInterface::ADDITIONAL_TEXT, $text);
    }
}
