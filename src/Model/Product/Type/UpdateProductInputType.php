<?php

namespace graphan\Magento2GraphQL\Model\Product\Type;

use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class UpdateProductInputType extends AbstractInputObjectType
{
    use ProductTypeTrait;

    public function build($config)
    {
        $this->getProductFields($config, true);
        $config->addField('sku', new NonNullType(new StringType()));
    }
}