<?php

namespace graphan\Magento2GraphQL\Model\Category\Type;

use graphan\Magento2GraphQL\Model\Product\Type\ProductType;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Category;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

abstract class AbstractCategoryType extends AbstractObjectType
{
    protected $categoryRepository;
    protected $categoryLinkManagement;
    protected $productRepository;

    public function __construct(\Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
                                \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
                                \Magento\Catalog\Api\CategoryLinkManagementInterface $categoryLinkManagement
    )
    {
        parent::__construct([]);
        $this->categoryRepository = $categoryRepository;
        $this->categoryLinkManagement = $categoryLinkManagement;
        $this->productRepository = $productRepository;
    }
    
    /**
     * @codeCoverageIgnore
     */
    protected function addCategoryProductsField(ObjectTypeConfig $config)
    {
        $config->addField('products', [
            'type' => new ListType(new ProductType()),
            'resolve' => function($value) {
                $this->resolveCategoryProducts($value);
            }
        ]);

    }

    private function resolveCategoryProducts($value)
    {
        $id = $this->getCategoryIdAsInt($value);
        $categoryProducts = $this->categoryLinkManagement->getAssignedProducts($id);
        return $this->getCategoryProducts($categoryProducts);
    }

    private function getCategoryProducts($categoryProducts)
    {
        $products = [];
        /** @var \Magento\Catalog\Model\Product $product */
        foreach ($categoryProducts as $product) {
            $products[] = $this->productRepository->get($product->getSku());
        }
        return $products;
    }


    private function getCategoryIdAsInt($value)
    {
        /** @var Category $value */
        return intval($value->getId());
    }
}