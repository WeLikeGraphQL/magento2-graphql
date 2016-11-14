<?php

namespace graphan\Magento2GraphQL\Model\Category;


use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use Youshido\GraphQL\Execution\ResolveInfo;

class CategoryRepositoryAdapter extends AbstractRepositoryAdapter
{
    private $categoryManagement;
    private $categoryRepository;

    public function __construct(\Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
                                \Magento\Catalog\Api\CategoryManagementInterface $categoryManagement)
    {
        $this->categoryManagement = $categoryManagement;
        $this->categoryRepository = $categoryRepository;
    }

    public function get(array $params)
    {
        return $this->invokeWithArray($this->categoryRepository, 'get', $params);
    }

    public function getList(array $params, ResolveInfo $info = null)
    {
        return $this->invokeWithArray($this->categoryManagement, 'getTree', $params);
    }

    public function delete(array $params)
    {
        return $this->invokeWithArray($this->categoryRepository, 'deleteByIdentifier', $params);
    }

    public function save(array $params)
    {
        return $this->invokeWithArray($this->categoryRepository, 'save', $params);
    }
    
    public function getInputObjectInterfaceName()
    {
        return 'Magento\Catalog\Api\Data\CategoryInterface';
    }

    public function move(array $params)
    {
        return $this->invokeWithArray($this->categoryManagement, 'move', $params);
    }
}