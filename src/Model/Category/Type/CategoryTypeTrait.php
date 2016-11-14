<?php

namespace graphan\Magento2GraphQL\Model\Category\Type;


use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
trait CategoryTypeTrait
{
    public function addCommonFields (ObjectTypeConfig $config)
    {
        $config->addField('id', new StringType())
            ->addField('parent_id', new StringType())
            ->addField('name', new StringType())
            ->addField('is_active', new BooleanType())
            ->addField('position', new StringType())
            ->addField('level', new StringType());
    }
    
    public function addCategoryFields (ObjectTypeConfig $config)
    {
        $config->addField('created_at', new StringType())
            ->addField('updated_at', new StringType())
            ->addField('path', new StringType())
            ->addField('include_in_menu', new BooleanType())
            ->addField('display_mode', new StringType());
    }
}