<?php

namespace graphan\Magento2GraphQL\Field;

use Youshido\GraphQL\Execution\ResolveInfo;

class GetListField extends AbstractMagentoField
{
    public function resolve($value, array $args, ResolveInfo $info)
    {
        $result = $this->getRepository()->getList($args);
        return $result;
    }
}