<?php

namespace graphan\Magento2GraphQL\Model\Category\Type;

use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IntType;

/**
 * @codeCoverageIgnore
 */
class UpdateCategoryInputType extends AbstractInputObjectType
{
    use CategoryTypeTrait;

    public function build($config)
    {
        $this->addCommonFields($config);
        $this->addCategoryFields($config);
        $this->addRequiredFields($config);
    }

    private function addRequiredFields(ObjectTypeConfig $config)
    {
        $config->addField('id', new NonNullType(new IntType()));
    }
}