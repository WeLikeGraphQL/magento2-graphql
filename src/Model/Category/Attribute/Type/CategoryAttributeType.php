<?php

namespace graphan\Magento2GraphQL\Model\Category\Attribute\Type;


use graphan\Magento2GraphQL\Model\Attribute\Type\AttributeTypeTrait;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class CategoryAttributeType extends AbstractObjectType
{
    use AttributeTypeTrait;

    public function build($config)
    {
        $this->addAttributeFields($config);
        $this->addRequiredFields($config);
    }

    private function addRequiredFields(ObjectTypeConfig $config)
    {
        $config->addField('attribute_code', new NonNullType(new StringType()))
            ->addField('frontend_input', new NonNullType(new StringType()))
            ->addField('frontend_labels', new NonNullType(new StringType()));
    }
}