<?php

namespace graphan\Magento2GraphQL\Test\Unit;

use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use graphan\Magento2GraphQL\Api\SearchCriteriaHelperInterface;
use graphan\Magento2GraphQL\Field\SearchField;
use Magento\Framework\Webapi\ServicePayloadConverterInterface;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;

class SearchFieldTest extends \PHPUnit_Framework_TestCase
{
    private $servicePayloadConverterMock;
    private $abstractRepoAdapterMock;
    private $abstractTypeMock;
    private $field;
    private $resolveInfoMock;
    private $searchCriteriaHelperMock;
    private $expectedResult = 'result';
    private $args = [
        'category' => [
            'name' => 'new cat',
            'id' => 46
        ]
    ];

    public function setUp()
    {
        $this->servicePayloadConverterMock = $this->getMockBuilder(ServicePayloadConverterInterface::class)
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

        $this->resolveInfoMock = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testResolve_ShouldReturnExpectedResult()
    {
        $this->field = new SearchField(
            $this->abstractRepoAdapterMock,
            $this->abstractTypeMock,
            "category",
            $this->searchCriteriaHelperMock,
            [],
            $this->servicePayloadConverterMock);

        $searchCriteriaInterfaceName = 'search_criteria_interface_name';
        $convertedValue = 'converted_value';

        $this->searchCriteriaHelperMock->expects($this->once())
            ->method('getSearchCriteriaInterfaceName')
            ->will($this->returnValue($searchCriteriaInterfaceName));

        $this->servicePayloadConverterMock->expects($this->once())
            ->method('convertValue')
            ->with(
                $this->args,
                $searchCriteriaInterfaceName
            )
            ->will($this->returnValue($convertedValue));

        $this->abstractRepoAdapterMock->expects($this->once())
            ->method('getList')
            ->with([0 => $convertedValue])
            ->will($this->returnValue($this->expectedResult));

        $result = $this->field->resolve(null, $this->args, $this->resolveInfoMock);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testConvertSearchCriteria_ShouldReturnAppropriateArray()
    {
        $class = new \ReflectionClass('graphan\Magento2GraphQL\Field\SearchField');
        $method = $class->getMethod('getSearchCriteriaStructure');
        $method->setAccessible(true);

        $this->field = new SearchField(
            $this->abstractRepoAdapterMock,
            $this->abstractTypeMock,
            "category",
            $this->searchCriteriaHelperMock,
            [],
            $this->servicePayloadConverterMock);

        $args = [];
        $args['filters'] = [
            [
                ['field' => 'field1', 'value' => 'value1', 'conditionType' => 'eq']
            ],
            [
                ['field' => 'field2', 'value' => 'value2', 'conditionType' => 'eq'],
                ['field' => 'field3', 'value' => 'value3', 'conditionType' => 'eq']
            ]
        ];

        $result = $method->invokeArgs($this->field, array($args));

        $this->assertEquals(key($result), 'filterGroups');
        $this->assertEquals($result['filterGroups'][0]['filters'][0],
                            ['field' => 'field1', 'value' => 'value1', 'conditionType' => 'eq']);
        $this->assertEquals($result['filterGroups'][1]['filters'][0],
                            ['field' => 'field2', 'value' => 'value2', 'conditionType' => 'eq']);
        $this->assertEquals($result['filterGroups'][1]['filters'][1],
                            ['field' => 'field3', 'value' => 'value3', 'conditionType' => 'eq']);
    }
}