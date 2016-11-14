<?php

namespace graphan\Magento2GraphQL\Test\Unit;

use graphan\Magento2GraphQL\Api\AbstractRepositoryAdapter;
use graphan\Magento2GraphQL\Api\SearchCriteriaHelperInterface;
use graphan\Magento2GraphQL\Field\DeleteField;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;

class DeleteFieldTest extends \PHPUnit_Framework_TestCase
{
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
        $this->field = new DeleteField(
            $this->abstractRepoAdapterMock,
            $this->abstractTypeMock,
            "category",
            $this->searchCriteriaHelperMock);

        $this->abstractRepoAdapterMock->expects($this->once())
            ->method('delete')
            ->with($this->args)
            ->will($this->returnValue($this->expectedResult));

        $result = $this->field->resolve(null, $this->args, $this->resolveInfoMock);

        $this->assertEquals($this->expectedResult, $result);
    }
}