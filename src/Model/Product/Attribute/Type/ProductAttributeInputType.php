<?php

namespace graphan\Magento2GraphQL\Model\Product\Attribute\Type;

use graphan\Magento2GraphQL\Model\Attribute\Type\AttributeTypeTrait;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\InputObject\InputObjectType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class ProductAttributeInputType extends AbstractInputObjectType
{
    use AttributeTypeTrait;

    public function build($config){
        $this->addAttributeFields($config);
        $this->addRequiredFields($config);
    }

    public function addRequiredFields(ObjectTypeConfig $config)
    {
        $config->addField('attribute_code', new NonNullType(new StringType()))
            ->addField('frontend_labels', new NonNullType(new ListType(new InputObjectType([
                'name' => 'FrontendLabels',
                'fields' => [
                    'store_id' => new IntType(),
                    'label' => new StringType()
                ]
            ]))))
            ->addField('frontend_input', new NonNullType(new StringType()))
            ->addField('frontend_class', new StringType());
    }
}