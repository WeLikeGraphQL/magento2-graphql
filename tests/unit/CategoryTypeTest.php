<?php

namespace graphan\Magento2GraphQL\Test\Unit;

use graphan\Magento2GraphQL\Model\Category\Type\CategoryType;
use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Category;

class CategoryTypeTest extends \PHPUnit_Framework_TestCase
{
    private $categoryRepoMock;
    private $productRepoMock;
    private $categoryLinkManagementMock;
    private $categoryMock;
    private $method;
    private $categoryType;

    public function setUp()
    {
        $class = new \ReflectionClass('graphan\Magento2GraphQL\Model\Category\Type\CategoryType');
        $this->method = $class->getMethod('resolveCategoryChildren');
        $this->method->setAccessible(true);

        $this->categoryRepoMock = $this->getMockBuilder(CategoryRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productRepoMock = $this->getMockBuilder(ProductRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryLinkManagementMock = $this->getMockBuilder(CategoryLinkManagementInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryMock = $this->getMockBuilder(Category::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryType = new CategoryType($this->categoryRepoMock,
            $this->productRepoMock,
            $this->categoryLinkManagementMock);
    }

    public function testResolveCategoryChildren_WhenNoCategoryChildren_ShouldReturnEmptyArray()
    {
        $this->categoryMock->expects($this->once())
            ->method('getAllChildren')
            ->with(true)
            ->willReturn([]);

        $result = $this->method->invokeArgs($this->categoryType, array($this->categoryMock));

        $this->assertEquals($result, []);
    }

    public function testResolveCategoryChildren_WhenCategoryChildren_ShouldReturnExpectedResultAsArray()
    {
        $this->categoryMock->expects($this->once())
            ->method('getAllChildren')
            ->with(true)
            ->willReturn([7, 8, 9]);

        $this->categoryRepoMock->expects($this->exactly(3))
            ->method('get')
            ->withConsecutive([7], [8], [9])
            ->willReturn($this->categoryMock);

        $this->categoryMock->expects($this->exactly(3))
            ->method('getData')
            ->willReturn('result');

        $result = $this->method->invokeArgs($this->categoryType, array($this->categoryMock));

        $this->assertEquals('result', $result[0]);
        $this->assertEquals('result', $result[1]);
        $this->assertEquals('result', $result[2]);
    }
}