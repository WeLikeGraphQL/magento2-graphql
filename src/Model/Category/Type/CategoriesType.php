<?php

namespace graphan\Magento2GraphQL\Model\Category\Type;

use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Scalar\IntType;

/**
 * @codeCoverageIgnore
 */
class CategoriesType extends AbstractCategoryType
{
    use CategoryTypeTrait;

    public function build($config)
    {
        $this->addCommonFields($config);
        $this->addCategoryProductsField($config);
        $this->addAdditionalFields($config);
    }

    private function addAdditionalFields(ObjectTypeConfig $config)
    {
        $config->addField('product_count', new IntType())
            // ListType cannot be defined in di.xml file, because it will cause infinite looping.
            // Unfortunately, ListType does not expose `setItems` function.
            // Types need to be set through the constructor.
            ->addField('children_data', new ListType(new CategoriesType($this->categoryRepository, $this->productRepository, $this->categoryLinkManagement)));
    }
}