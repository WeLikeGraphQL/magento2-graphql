<?php

namespace graphan\Magento2GraphQL\Type;

use Youshido\GraphQL\Type\AbstractType;

/**
 * @codeCoverageIgnore
 */
class NonNullType extends \Youshido\GraphQL\Type\NonNullType
{
    public function __construct(AbstractType $fieldType)
    {
        parent::__construct($fieldType);
    }
}