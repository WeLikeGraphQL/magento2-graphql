<?php

namespace graphan\Magento2GraphQL\Test\Unit;


use graphan\Magento2GraphQL\Model\Category\CategoryRepositoryAdapter;
use Magento\Catalog\Api\CategoryManagementInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Category;

class CategoryRepositoryAdapterTest extends \PHPUnit_Framework_TestCase
{
    private $categoryRepoMock;
    private $categoryManagementMock;
    private $categoryRepoAdapter;
    private $categoryMock;
    private $expectedResult;

    public function setUp()
    {
        $this->categoryMock = $this->getMockBuilder(Category::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryRepoMock = $this->getMockBuilder(CategoryRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryManagementMock = $this->getMockBuilder(CategoryManagementInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryRepoAdapter = new CategoryRepositoryAdapter($this->categoryRepoMock,
            $this->categoryManagementMock);

        $this->expectedResult = 'result';
    }

    public function testGet_ShouldReturnExpectedResult()
    {
        $this->categoryRepoMock->expects($this->once())
            ->method('get')
            ->with($this->categoryMock)
            ->willReturn($this->expectedResult);

        $result = $this->categoryRepoAdapter->get([$this->categoryMock]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testGetList_ShouldReturnExpectedResult()
    {
        $this->categoryManagementMock->expects($this->once())
            ->method('getTree')
            ->willReturn($this->expectedResult);

        $result = $this->categoryRepoAdapter->getList([]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testDelete_ShouldReturnExpectedResult()
    {
        $this->categoryRepoMock->expects($this->once())
            ->method('deleteByIdentifier')
            ->with($this->categoryMock)
            ->willReturn($this->expectedResult);

        $result = $this->categoryRepoAdapter->delete([$this->categoryMock]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testSave_ShouldReturnExpectedResult()
    {
        $this->categoryRepoMock->expects($this->once())
            ->method('save')
            ->with($this->categoryMock)
            ->willReturn($this->expectedResult);

        $result = $this->categoryRepoAdapter->save([$this->categoryMock]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testMove_ShouldReturnExpectedResult()
    {
        $params = [0, 1];

        $this->categoryManagementMock->expects($this->once())
            ->method('move')
            ->with($params[0], $params[1])
            ->willReturn($this->expectedResult);

        $result = $this->categoryRepoAdapter->move($params);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testGetInputObjectInterfaceName_ShouldReturnString()
    {
        $result = $this->categoryRepoAdapter->getInputObjectInterfaceName();
        $this->assertInternalType('string', $result);
    }
}