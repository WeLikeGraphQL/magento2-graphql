<?php

namespace graphan\Magento2GraphQL\Field;

use Youshido\GraphQL\Execution\ResolveInfo;

class AddUpdateField extends AbstractMagentoField
{
    public function resolve($value, array $args, ResolveInfo $info)
    {
        $inputParams = $this->convertInputParams($args);
        $result = $this->getRepository()->save($inputParams);
        return $result;
    }

    private function convertInputParams($args)
    {
        $inputParams = [];
        $key = key($args);
        $inputParams[] = $this->convertValue($args[$key], $this->getRepository()->getInputObjectInterfaceName());
        return $inputParams;
    }
}