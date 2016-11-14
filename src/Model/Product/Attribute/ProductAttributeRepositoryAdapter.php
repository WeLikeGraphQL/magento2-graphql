<?php

namespace graphan\Magento2GraphQL\Model\Product\Attribute;


use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use Youshido\GraphQL\Execution\ResolveInfo;

class ProductAttributeRepositoryAdapter extends AbstractRepositoryAdapter
{
    private $productAttributeRepository;

    public function __construct(\Magento\Catalog\Api\ProductAttributeRepositoryInterface $productAttributeRepository)
    {
        $this->productAttributeRepository = $productAttributeRepository;
    }

    public function get(array $params)
    {
        return $this->invokeWithArray($this->productAttributeRepository, 'get', $params);
    }

    public function getList(array $params, ResolveInfo $info = null)
    {
        return $this->invokeWithArray($this->productAttributeRepository, 'getList', $params);
    }

    public function delete(array $params)
    {
        return $this->invokeWithArray($this->productAttributeRepository, 'deleteById', $params);
    }

    public function save(array $params)
    {
        return $this->invokeWithArray($this->productAttributeRepository, 'save', $params);
    }
    
    public function getInputObjectInterfaceName()
    {
        return 'Magento\Catalog\Api\Data\ProductAttributeInterface';
    }
}