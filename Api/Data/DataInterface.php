<?php

namespace ChrisMallory\CodeSample\Api\Data;

/**
 * Interface DataInterface
 *
 * @package ChrisMallory\CodeSample\Api\Data
 */
interface DataInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID           = 'entity_id';
    /**
     *
     */
    const PRODUCT_SKU        = 'product_sku';
    /**
     *
     */
    const ADDITIONAL_TEXT  = 'additional_text';


    /**
     * Get ID
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set ID
     *
     * @param $id
     * @return DataInterface
     */
    public function setEntityId($id);

    /**
     * Get Product SKU
     *
     * @return string
     */
    public function getProductSku();

    /**
     * Set Product SKU
     *
     * @param $sku
     * @return mixed
     */
    public function setProductSku($sku);

    /**
     * Get Additional Text
     *
     * @return mixed
     */
    public function getAdditionalText();

    /**
     * Set Additional Text
     *
     * @param $text
     * @return mixed
     */
    public function setAdditionalText($text);

}
