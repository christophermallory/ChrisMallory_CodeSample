<?php

namespace ChrisMallory\CodeSample\Setup;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;
use Magento\Config\Model\ResourceModel\Config\Data;
use Magento\Config\Model\ResourceModel\Config\Data\CollectionFactory;

/**
 * Class Uninstall
 *
 * @package ChrisMallory\CodeSample\Setup
 */
class Uninstall implements UninstallInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var Data
     */
    protected $configResource;

    /**
     * @param CollectionFactory $collectionFactory
     * @param Data $configResource
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Data $configResource
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->configResource    = $configResource;
    }

    /**
     * Drop sample table
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if ($setup->tableExists('chrismallory_code_sample')) {
            $setup->getConnection()->dropTable('chrismallory_code_sample');
        }
        $collection = $this->collectionFactory->create()
            ->addPathFilter('ChrisMallory_CodeSample');
        foreach ($collection as $config) {
            $this->deleteConfig($config);
        }
    }

    /**
     * Delete system config
     *
     * @param AbstractModel $config
     */
    protected function deleteConfig(AbstractModel $config)
    {
        $this->configResource->delete($config);
    }
}
