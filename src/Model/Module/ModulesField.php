<?php

namespace graphan\Magento2GraphQL\Model\Module;

use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Scalar\StringType;

class ModulesField extends AbstractField
{
    private $moduleService;

    public function __construct(\Magento\Backend\Service\V1\ModuleServiceInterface $moduleService)
    {
        parent::__construct([]);
        $this->moduleService = $moduleService;
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        $result = $this->moduleService->getModules();
        return $result;
    }

    public function getType()
    {
        return new ListType(new StringType());
    }
}