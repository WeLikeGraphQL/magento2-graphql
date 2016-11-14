<?php

namespace graphan\Magento2GraphQL\Api;
use Youshido\GraphQL\Execution\ResolveInfo;

/**
 * @api
 */
abstract class AbstractRepositoryAdapter
{
    abstract public function get(array $params);
    abstract public function getList(array $params, ResolveInfo $info = null);
    abstract public function delete(array $params);
    abstract public function save(array $params);
    abstract public function getInputObjectInterfaceName();
    
    protected function invokeWithArray($repository, $function, $params)
    {
        return call_user_func_array(array($repository, $function), $params);
    }
}