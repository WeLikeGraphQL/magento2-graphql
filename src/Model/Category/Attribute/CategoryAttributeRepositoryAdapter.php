<?php

namespace graphan\Magento2GraphQL\Model\Category\Attribute;


use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use Youshido\GraphQL\Execution\ResolveInfo;

class CategoryAttributeRepositoryAdapter extends AbstractRepositoryAdapter
{
    private $categoryAttributeRepository;

    public function __construct(\Magento\Catalog\Api\CategoryAttributeRepositoryInterface $categoryAttributeRepository)
    {
        $this->categoryAttributeRepository = $categoryAttributeRepository;
    }

    public function get(array $params)
    {
        return $this->invokeWithArray($this->categoryAttributeRepository, 'get', $params);
    }

    public function getList(array $params, ResolveInfo $info = null)
    {
        return $this->invokeWithArray($this->categoryAttributeRepository, 'getList', $params);
    }
    
    public function getInputObjectInterfaceName()
    {
        return 'Magento\Catalog\Api\Data\CategoryAttributeInterface';
    }

    /**
     * @codeCoverageIgnore
     */
    public function delete(array $params)
    {
        return null;
    }

    /**
     * @codeCoverageIgnore
     */
    public function save(array $params)
    {
        return null;
    }
}