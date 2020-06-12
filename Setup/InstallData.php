<?php

namespace ChrisMallory\CodeSample\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

/**
 * Class InstallData
 *
 * @package ChrisMallory\CodeSample\Setup
 */
class InstallData implements InstallDataInterface
{

    /**
     * Install sample data
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.0', '<')) {
            $data = [
                [
                    'product_sku' => '001-01',
                    'additional_text' => 'Text 1'
                ],
                [
                    'product_sku' => '001-02',
                    'additional_text' => 'Text 2'
                ],
                [
                    'product_sku' => '001-03',
                    'additional_text' => 'Text 3'
                ],
                [
                    'product_sku' => '001-04',
                    'additional_text' => 'Text 4'
                ],
                [
                    'product_sku' => '001-05',
                    'additional_text' => 'Text 5'
                ]
            ];

            foreach ($data as $datum) {
                $setup->getConnection()
                    ->insertForce($setup->getTable('chrismallory_code_sample'), $datum);
            }
        }
    }
}
