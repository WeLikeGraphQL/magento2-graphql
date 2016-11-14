<?php

namespace graphan\Magento2GraphQL\Field;

use graphan\Magento2GraphQL\Type\ListType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\InputObject\InputObjectType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

class SearchField extends AbstractMagentoField
{
    public function build(FieldConfig $config)
    {
        $config->addArgument('pageSize', new IntType())
            ->addArgument('currentPage', new IntType())
            ->addArgument('filters', new ListType(new ListType(new InputObjectType([
                'name' => 'Filter',
                'fields' => [
                    'field' => new StringType(),
                    'value' => new StringType(),
                    'conditionType' => new StringType()
                ]
            ]))))
            ->addArgument('sortOrders', new ListType(new InputObjectType([
                'name' => 'SortOrder',
                'fields' => [
                    'field' => new StringType(),
                    'direction' => new StringType()
                ]
            ])));
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        $inputParams = $this->convertSearchCriteria($args);
        $result = $this->getRepository()->getList($inputParams, $info);
        return $result;
    }

    private function convertSearchCriteria($args)
    {
        $inputParams = [];
        $searchCriteria = $this->getSearchCriteriaStructure($args);
        $inputParams[] = $this->convertValue(
                $searchCriteria,
                $this->getSearchCriteriaHelper()->getSearchCriteriaInterfaceName()
            );
        return $inputParams;
    }

    private function getSearchCriteriaStructure($args)
    {
        $inputParams = $args;
        if (!empty($args['filters'])) {
            $inputParams['filterGroups'] = [];
            $id = 0;
            foreach($args['filters'] as $filterGroup) {
                $inputParams['filterGroups'][$id]['filters'] = [];
                foreach($filterGroup as $filter) {
                    $inputParams['filterGroups'][$id]['filters'][] = $filter;
                }
                $id++;
            }
            unset($inputParams['filters']);
        }
        return $inputParams;
    }
}