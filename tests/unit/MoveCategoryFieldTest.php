<?php

namespace graphan\Magento2GraphQL\Test\Unit;

use graphan\Magento2GraphQL\Api\SearchCriteriaHelperInterface;
use graphan\Magento2GraphQL\Model\Category\CategoryRepositoryAdapter;
use graphan\Magento2GraphQL\Model\Category\Field\MoveCategoryField;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;

class MoveCategoryFieldTest extends \PHPUnit_Framework_TestCase
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
        $this->abstractRepoAdapterMock = $this->getMockBuilder(CategoryRepositoryAdapter::class)
            ->disableOriginalConstructor()
            ->getMock();

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
        $this->field = new MoveCategoryField(
            $this->abstractRepoAdapterMock,
            $this->abstractTypeMock,
            "category",
            $this->searchCriteriaHelperMock);

        $this->abstractRepoAdapterMock->expects($this->once())
            ->method('move')
            ->with($this->args)
            ->will($this->returnValue($this->expectedResult));

        $result = $this->field->resolve(null, $this->args, $this->resolveInfoMock);

        $this->assertEquals($this->expectedResult, $result);
    }
}