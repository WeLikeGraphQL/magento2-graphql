<?php

namespace graphan\Magento2GraphQL\Plugin;


use Magento\Catalog\Api\Data\ProductAttributeSearchResultsInterface;
use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Youshido\GraphQL\Parser\Ast\Field;

// codeCoverageIgnore because of lack of knowledge how to test with Closure
/**
 * @codeCoverageIgnore
 */
class ProductAttributeRepositoryPlugin
{
    /* @var Field[] */
    private $fields = [];
    /* @var ProductAttributeSearchResultsInterface */
    private $productAttributeSearchResult;
    /* @var ProductAttributeRepositoryInterface */
    private $productAttributeRepo;

    // TODO: constructor is not working - bug in Magneto 2?????
//    public function __constructor(ProductAttributeSearchResultsInterface $productAttributeSearchResult,
//                                  ProductAttributeRepositoryInterface $productAttributeRepo)
//    {
//        $this->productAttributeSearchResult = $productAttributeSearchResult;
//        $this->productAttributeRepo = $productAttributeRepo;
//    }

    public function aroundGetList(\Magento\Catalog\Api\ProductAttributeRepositoryInterface $subject,
                                  \Closure $proceed,
                                    SearchCriteriaInterface $searchCriteria)
    {
        if($this->fields == []) {
            return $proceed($searchCriteria);
        }

        $this->instantiateDeps();
        $this->setSearchResult();

        return $this->productAttributeSearchResult;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    private function setSearchResult()
    {
        $productAttributes = [];
        foreach($this->fields as $field)
        {
            // it is needed, because you cannot get `id` attribute
            if($field->getName() !== 'id') {
                $productAttributes[] = $this->productAttributeRepo->get($field->getName());
            }
        }
        $this->productAttributeSearchResult->setItems($productAttributes);
        $this->fields = [];
    }

    private function instantiateDeps()
    {
        // TODO: Do not use ObjectManager
        // it is used because above constructor is never invoked (bug in Magento2?)
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->productAttributeRepo = $objectManager->create('Magento\Catalog\Model\Product\Attribute\Repository');
        $this->productAttributeSearchResult = $objectManager->create('Magento\Framework\Api\SearchResults');
    }
}