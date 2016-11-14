<?php

namespace graphan\Magento2GraphQL\Model\Search;


use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
class FilterType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addField('field', new StringType())
                ->addField('value', new StringType())
                ->addField('conditionType', new StringType());
    }
}