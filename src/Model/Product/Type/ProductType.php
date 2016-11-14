<?php

namespace graphan\Magento2GraphQL\Model\Product\Type;

use Youshido\GraphQL\Type\Object\AbstractObjectType;

/**
 * @codeCoverageIgnore
 */
class ProductType extends AbstractObjectType
{
    use ProductTypeTrait;

    public function build($config)
    {
        $this->getProductFields($config);
    }
}