<?php

namespace graphan\Magento2GraphQL\Test\Unit;


use graphan\Magento2GraphQL\Field\AbstractMagentoField;
use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use graphan\Magento2GraphQL\Api\SearchCriteriaHelperInterface;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Type\AbstractType;

class AbstractMagentoFieldTest extends \PHPUnit_Framework_TestCase
{
    private $fieldConfigMock;
    private $abstractRepoAdapterMock;
    private $abstractTypeMock;
    private $searchCriteriaHelperMock;
    private $abstractMagentoFieldMock;


    public function setUp()
    {
        $this->mockDependencies();
    }

    public function testBuild_WhenNoInputTypes_ShouldNeverCallAddArgument()
    {
        $this->fieldConfigMock->expects($this->never())
            ->method('addArgument');

        $this->abstractMagentoFieldMock->build($this->fieldConfigMock);
    }

    public function testBuild_WhenInputTypes_ShouldCallAddArgument()
    {
        $inputTypes = [
            'key1' => 'value1',
            'key2' => 'value2'
        ];

        $this->mockAbstractMagentoField($inputTypes);

        $this->fieldConfigMock->expects($this->exactly(2))
            ->method('addArgument')
            ->withConsecutive(['key1', $inputTypes['key1']], ['key2', $inputTypes['key2']]);

        $this->abstractMagentoFieldMock->build($this->fieldConfigMock);
    }

    private function mockDependencies()
    {
        $this->fieldConfigMock = $this->getMockBuilder(FieldConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->abstractRepoAdapterMock = $this->getMockBuilder(AbstractRepositoryAdapter::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->abstractTypeMock = $this->getMockBuilder(AbstractType::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->searchCriteriaHelperMock = $this->getMockBuilder(SearchCriteriaHelperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockAbstractMagentoField();
    }

    private function mockAbstractMagentoField($inputTypes = [])
    {
        $this->abstractMagentoFieldMock = $this->getMockBuilder(AbstractMagentoField::class)
            ->setConstructorArgs(array($this->abstractRepoAdapterMock,
                $this->abstractTypeMock,
                'name',
                $this->searchCriteriaHelperMock,
                $inputTypes))
            ->getMockForAbstractClass();
    }

}