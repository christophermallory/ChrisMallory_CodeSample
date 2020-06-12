<?php
namespace ChrisMallory\CodeSample\Ui\Component\Create\Form\Product;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\App\RequestInterface;

/**
 * Class Options
 *
 * @package ChrisMallory\CodeSample\Ui\Component\Create\Form\Product
 */
class Options implements OptionSourceInterface
{

    /**
     * @var ProductCollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $productsArray;

    /**
     * @param ProductCollectionFactory $productCollectionFactory
     * @param RequestInterface $request
     */
    public function __construct(

        ProductCollectionFactory $productCollectionFactory,
        RequestInterface $request
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->request = $request;
    }

    /**
     * @return array|null
     */
    public function toOptionArray()
    {
        return $this->getProductArray();
    }

    /**
     * @return array|null
     */
    protected function getProductArray() {
        if ($this->productsArray === null) {
            $productCollection = $this->productCollectionFactory->create();

            $this->productsArray = [['label' => '', 'value' => '']];

            foreach($productCollection as $product) {
                $productSku = $product->getSku();

                $this->productsArray[] = [
                    'label' => $productSku,
                    'value' => $productSku
                ];
            }

            return $this->productsArray;
        }

    }
}
