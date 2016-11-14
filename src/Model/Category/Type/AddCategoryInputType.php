<?php

namespace graphan\Magento2GraphQL\Model\Category\Type;

use Youshido\GraphQL\Config\Object\InputObjectTypeConfig;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class AddCategoryInputType extends AbstractInputObjectType
{
    use CategoryTypeTrait;

    public function build($config)
    {
        $this->addCommonFields($config);
        $this->addCategoryFields($config);
        $this->addRequiredFields($config);
    }

    private function addRequiredFields(InputObjectTypeConfig $config)
    {
        $config->addField('name', new NonNullType(new StringType()))
            ->addField('is_active', new NonNullType(new BooleanType()));
    }
}