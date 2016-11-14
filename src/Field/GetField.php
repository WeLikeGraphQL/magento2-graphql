<?php

namespace graphan\Magento2GraphQL\Field;

use Youshido\GraphQL\Execution\ResolveInfo;

class GetField extends AbstractMagentoField
{
    public function resolve($value, array $args, ResolveInfo $info)
    {
        $result = $this->getRepository()->get($args);
        return $result;
    }
}