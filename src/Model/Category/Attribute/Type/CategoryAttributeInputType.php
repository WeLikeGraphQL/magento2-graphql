<?php

namespace graphan\Magento2GraphQL\Model\Category\Attribute\Type;

use graphan\Magento2GraphQL\Model\Attribute\Type\AttributeTypeTrait;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class CategoryAttributeInputType extends AbstractInputObjectType
{
    use AttributeTypeTrait;

    public function build($config){
        $this->addAttributeFields($config);
        $this->addRequiredFields($config);
    }

    private function addRequiredFields(ObjectTypeConfig $config)
    {
        $config->addField('attribute_id', new NonNullType(new StringType()));
    }
}