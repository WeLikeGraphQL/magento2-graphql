<?php

namespace graphan\Magento2GraphQL\Field;

use Youshido\GraphQL\Execution\ResolveInfo;

class DeleteField extends AbstractMagentoField
{
    public function resolve($value, array $args, ResolveInfo $info)
    {
        $result = $this->getRepository()->delete($args);
        return $result;
    }
}