<?php

namespace graphan\Magento2GraphQL\Model\Product;


use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use graphan\Magento2GraphQL\Plugin\ProductAttributeRepositoryPlugin;
use Youshido\GraphQL\Execution\ResolveInfo;

class ProductRepositoryAdapter extends AbstractRepositoryAdapter
{
    private $productRepository;
    private $plugin;

    public function __construct(\Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
                                ProductAttributeRepositoryPlugin $plugin)
    {
        $this->productRepository = $productRepository;
        $this->plugin = $plugin;
    }

    public function get(array $params)
    {
        return $this->invokeWithArray($this->productRepository, 'get', $params);
    }

    public function getList(array $params, ResolveInfo $info = null)
    {
        $this->plugin->setFields($info->getFieldASTList()[0]->getFields());
        return $this->invokeWithArray($this->productRepository, 'getList', $params);
    }

    public function delete(array $params)
    {
        return $this->invokeWithArray($this->productRepository, 'deleteById', $params);
    }

    public function save(array $params)
    {
        return $this->invokeWithArray($this->productRepository, 'save', $params);
    }
    
    public function getInputObjectInterfaceName()
    {
        return 'Magento\Catalog\Api\Data\ProductInterface';
    }
}