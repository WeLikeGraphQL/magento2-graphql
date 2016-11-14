<?php

namespace graphan\Magento2GraphQL\Model\Product\Type;

use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class AddProductInputType extends AbstractInputObjectType
{
    use ProductTypeTrait;

    public function build($config)
    {
        $this->getProductFields($config, true);
        $config->addField('sku', new NonNullType(new StringType()))
            ->addField('name', new NonNullType(new StringType()))
            ->addField('attribute_set_id', new NonNullType(new IntType()))
            ->addField('price', new NonNullType(new IntType()));
    }
}