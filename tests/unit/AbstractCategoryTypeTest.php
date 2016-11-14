<?php

namespace graphan\Magento2GraphQL\Test\Unit;

use graphan\Magento2GraphQL\Model\Category\Type\CategoryType;
use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Product;

class AbstractCategoryTypeTest extends \PHPUnit_Framework_TestCase
{
    private $productRepoMock;
    private $categoryLinkManagementMock;
    private $method;
    private $categoryMock;
    private $productMock;
    private $categoryRepoMock;
    private $categoryType;
    private $catId;

    public function setUp()
    {
        $this->setPrivateMethodAccessible();
        $this->mockDependencies();

        $this->categoryType = new CategoryType($this->categoryRepoMock,
            $this->productRepoMock,
            $this->categoryLinkManagementMock);
    }

    public function testResolveCategoryProducts_WhenNoCategoryProducts_ShouldReturnEmptyArray()
    {
        $expectedResult = [];

        $this->categoryLinkManagementMock->expects($this->once())
            ->method('getAssignedProducts')
            ->with($this->catId)
            ->willReturn($expectedResult);

        $this->assertEquals($expectedResult, $this->invokeMethod());
    }

    public function testResolveCategoryProducts_WhenCategoryProducts_ShouldReturnArrayWithProducts()
    {
        $expectedResult = [
            0 => $this->productMock,
            1 => $this->productMock
        ];
        $sku = ['sku1', 'sku2'];

        $this->categoryLinkManagementMock->expects($this->once())
            ->method('getAssignedProducts')
            ->with($this->catId)
            ->willReturn($expectedResult);

        $this->productMock->expects($this->exactly(2))
            ->method('getSku')
            ->will($this->onConsecutiveCalls($sku[0], $sku[1]));

        $this->productRepoMock->expects($this->exactly(2))
            ->method('get')
            ->withConsecutive(
                [$sku[0]],
                [$sku[1]]
            )
            ->will($this->onConsecutiveCalls($expectedResult[0], $expectedResult[1]));

        $this->assertEquals($expectedResult, $this->invokeMethod());
    }

    private function mockDependencies()
    {
        $this->catId = 3;

        $this->categoryMock = $this->getMockBuilder(Category::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productMock = $this->getMockBuilder(\Magento\Catalog\Model\Product::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryRepoMock = $this->getMockBuilder(CategoryRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productRepoMock = $this->getMockBuilder(ProductRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryLinkManagementMock = $this->getMockBuilder(CategoryLinkManagementInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryMock->expects($this->once())
            ->method('getId')
            ->willReturn($this->catId);
    }

    private function setPrivateMethodAccessible()
    {
        $class = new \ReflectionClass('graphan\Magento2GraphQL\Model\Category\Type\AbstractCategoryType');
        $this->method = $class->getMethod('resolveCategoryProducts');
        $this->method->setAccessible(true);
    }

    private function invokeMethod()
    {
        return $this->method->invokeArgs($this->categoryType,
            array($this->categoryMock)
        );
    }
}