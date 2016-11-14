<?php

namespace graphan\Magento2GraphQL\Model\Search;

use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class SearchCriteriaType extends AbstractObjectType
{
    public function build($config)  // implementing an abstract function where you build your type
    {
        $config
            ->addField('filter_groups', new ListType(new ObjectType([
                'name' => 'FilterGroups',
                'fields' => [
                    'filters' => new ListType(new ObjectType([
                        'name' => 'Filters',
                        'fields' => [
                            'field' => new StringType(),
                            'value' => new StringType(),
                            'condition_type' => new StringType()
                        ]
                    ]))
                ]
            ])))
            ->addField('sort_orders', new ListType(new ObjectType([
                'name' => 'SortOrders',
                'fields' => [
                    'field' => new StringType(),
                    'direction' => new StringType()
                ]
            ])))
            ->addField('page_size', new IntType())
            ->addField('current_page', new IntType());
    }

    public function getName()
    {
        return "SearchCriteria";
    }
}