<?php

namespace graphan\Magento2GraphQL\Model\Category\Type;

use Magento\Catalog\Model\Category;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\ListType\ListType;

class CategoryType extends AbstractCategoryType
{
    use CategoryTypeTrait;

    /**
     * @codeCoverageIgnore
     */
    public function build($config)
    {
        $this->addCommonFields($config);
        $this->addCategoryFields($config);
        $this->addCategoryProductsField($config);
        $this->addCategoryChildrenField($config);
    }

    /**
     * @codeCoverageIgnore
     */
    private function addCategoryChildrenField(ObjectTypeConfig $config)
    {
        $config->addField('children', [
            // ListType cannot be defined in di.xml file, because it will cause infinite looping.
            // Unfortunately, ListType does not expose `setItems` function.
            // Types need to be set through the constructor.
            'type' => new ListType(new CategoryType($this->categoryRepository, $this->productRepository, $this->categoryLinkManagement)),
            'resolve' => function($value){
                return $this->resolveCategoryChildren($value);
            }
        ]);
    }

    private function resolveCategoryChildren(\Magento\Catalog\Model\Category $value)
    {
        $result = [];
        foreach ($value->getAllChildren(true) as $categoryId) {
            /** @var Category $category */
            $category = $this->categoryRepository->get($categoryId);
            $result[] = $category->getData();
        }
        return $result;
    }
}