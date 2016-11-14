<?php

namespace graphan\Magento2GraphQL\Type;

use Youshido\GraphQL\Config\Object\ListTypeConfig;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\ListType\AbstractListType;

/**
 * @codeCoverageIgnore
 */
class ListType extends AbstractListType
{
    public function __construct(AbstractType $itemType)
    {
        $this->config = new ListTypeConfig(['itemType' => $itemType], $this, true);
    }

    public function getItemType()
    {
        return $this->getConfig()->get('itemType');
    }

    public function getName()
    {
        return null;
    }
}