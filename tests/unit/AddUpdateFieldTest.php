<?php

namespace graphan\Magento2GraphQL\Test\Unit;

use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use graphan\Magento2GraphQL\Api\SearchCriteriaHelperInterface;
use graphan\Magento2GraphQL\Field\AddUpdateField;
use Magento\Framework\Webapi\ServicePayloadConverterInterface;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;

class AddUpdateFieldTest extends \PHPUnit_Framework_TestCase
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
        $this->mockDependencies();

        $this->field = new AddUpdateField(
            $this->abstractRepoAdapterMock,
            $this->abstractTypeMock,
            "category",
            $this->searchCriteriaHelperMock,
            [],
            $this->servicePayloadConverterMock);
    }

    public function testResolve_ShouldInvokeCorrectFunctionsAndReturnExpectedResult()
    {
        $convertedValue = 'converted_value';
        $inputObjectInterface = 'input_object_interface';

        $this->abstractRepoAdapterMock->expects($this->once())
            ->method('getInputObjectInterfaceName')
            ->willReturn($inputObjectInterface);

        $this->servicePayloadConverterMock->expects($this->once())
            ->method('convertValue')
            ->with(
                $this->args['category'],
                $inputObjectInterface
            )
            ->willReturn($convertedValue);

        $this->abstractRepoAdapterMock->expects($this->once())
            ->method('save')
            ->with([0 => $convertedValue])
            ->will($this->returnValue($this->expectedResult));

        $result = $this->field->resolve(null, $this->args, $this->resolveInfoMock);

        $this->assertEquals($this->expectedResult, $result);
    }

    private function mockDependencies()
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
}