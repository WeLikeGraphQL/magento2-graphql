<?php

namespace graphan\Magento2GraphQL\Type;

use Youshido\GraphQL\Config\Object\InputObjectTypeConfig;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;

/**
 * @codeCoverageIgnore
 */
class InputObjectType extends AbstractInputObjectType
{
    public function __construct(AbstractInputObjectType $fieldType)
    {
        $config = $this->getConfigAsArray($fieldType);
        $this->config = new InputObjectTypeConfig($config, $this, true);
    }

    // TODO: test it despite of the fact that here Trait is used
    private function getConfigAsArray(AbstractInputObjectType $fieldType)
    {
        $config = [];
        $config['name'] = $fieldType->getConfigValue('name');
        $config['fields'] = $fieldType->getConfig()->getFields();
        return $config;
    }

    public function build($config)
    {
    }
}