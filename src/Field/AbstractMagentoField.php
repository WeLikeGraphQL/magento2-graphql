<?php

namespace graphan\Magento2GraphQL\Field;

use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use graphan\Magento2GraphQL\Api\SearchCriteriaHelperInterface;
use Magento\Framework\Webapi\ServicePayloadConverterInterface;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\AbstractType;

abstract class AbstractMagentoField extends AbstractField
{
    private $inputTypes;
    private $name;
    private $responseType;
    private $repository;
    private $searchCriteriaHelper;
    private $servicePayloadConverter;

    public function __construct(AbstractRepositoryAdapter $repository,
                                AbstractType $responseType,
                                $name,
                                SearchCriteriaHelperInterface $searchCriteriaHelper,
                                $inputTypes = [],
                                ServicePayloadConverterInterface $servicePayloadConverter = null)
    {
        $this->inputTypes = $inputTypes;
        $this->name = $name;
        $this->repository = $repository;
        $this->responseType = $responseType;
        $this->searchCriteriaHelper = $searchCriteriaHelper;
        $this->servicePayloadConverter = $servicePayloadConverter;
        parent::__construct([]);
    }

    public function build(FieldConfig $config)
    {
        foreach ($this->inputTypes as $argName => $argType)
        {
            $config->addArgument($argName, $argType);
        }
    }

    public function getType()
    {
        return $this->responseType;
    }

    public function getName()
    {
        return $this->name;
    }

//    protected function getInputTypes()
//    {
//        return $this->inputTypes;
//    }

    protected function getRepository()
    {
        return $this->repository;
    }

    protected function getSearchCriteriaHelper()
    {
        return $this->searchCriteriaHelper;
    }

    protected function convertValue($input, $interface)
    {
        return $this->servicePayloadConverter->convertValue($input, $interface);
    }
}