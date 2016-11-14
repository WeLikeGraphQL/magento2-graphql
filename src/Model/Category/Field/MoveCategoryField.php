<?php

namespace graphan\Magento2GraphQL\Model\Category\Field;

use graphan\Magento2GraphQL\Field\AbstractMagentoField;
use Youshido\GraphQL\Execution\ResolveInfo;

class MoveCategoryField extends AbstractMagentoField
{
    public function resolve($value, array $args, ResolveInfo $info)
    {
        $result = $this->getRepository()->move($args);
        return $result;
    }
}