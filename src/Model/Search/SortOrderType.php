<?php

namespace graphan\Magento2GraphQL\Model\Search;


use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class SortOrderType extends AbstractInputObjectType
{
    public function build($config)
    {
        $config->addField('field', new StringType())
                ->addField('direction', new StringType());
    }

    public function getName()
    {
        return 'SortOrder';
    }
}