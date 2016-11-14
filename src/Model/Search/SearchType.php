<?php

namespace graphan\Magento2GraphQL\Model\Search;


use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IntType;

class SearchType extends AbstractObjectType
{
    private $responseType;

    public function __construct(AbstractObjectType $responseType)
    {
        $this->responseType = $responseType;
        parent::__construct([]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function build($config)
    {
        $config->addField('items', new ListType($this->responseType))
                ->addField('search_criteria', new SearchCriteriaType())
                ->addField('total_count', new IntType());
    }

    public function getName()
    {
        return $this->responseType->getName()."s";
    }
}