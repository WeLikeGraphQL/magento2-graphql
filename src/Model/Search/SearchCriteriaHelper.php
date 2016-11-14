<?php

namespace graphan\Magento2GraphQL\Model\Search;


use graphan\Magento2GraphQL\Model\Api\SearchCriteriaHelperInterface;

/**
 * @codeCoverageIgnore
 */
class SearchCriteriaHelper implements SearchCriteriaHelperInterface
{
    public function getSearchCriteriaInterfaceName()
    {
        return 'Magento\Framework\Api\SearchCriteriaInterface';
    }
}