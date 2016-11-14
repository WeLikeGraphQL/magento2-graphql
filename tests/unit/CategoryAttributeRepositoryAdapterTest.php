<?php

namespace graphan\Magento2GraphQL\Test\Unit;

use graphan\Magento2GraphQL\Model\Category\Attribute\CategoryAttributeRepositoryAdapter;
use Magento\Catalog\Api\CategoryAttributeRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class CategoryAttributeRepositoryAdapterTest extends \PHPUnit_Framework_TestCase
{
    private $adapter;
    private $categoryAttributeRepoMock;
    private $expectedResult;

    public function setUp()
    {
        $this->categoryAttributeRepoMock = $this->getMockBuilder(CategoryAttributeRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->adapter = new CategoryAttributeRepositoryAdapter($this->categoryAttributeRepoMock);

        $this->expectedResult = 'result';
    }

    public function testGet_ShouldReturnExpectedResult()
    {
        $arg = 'attr_code';

        $this->categoryAttributeRepoMock->expects($this->once())
            ->method('get')
            ->with($arg)
            ->will($this->returnValue($this->expectedResult));

        $result = $this->adapter->get([$arg]);

        $this->assertEquals($result, $this->expectedResult);
    }

    public function testGetList_ShouldReturnExpectedResult()
    {
        $searchCriteriaMock = $this->getMockBuilder(SearchCriteriaInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryAttributeRepoMock->expects($this->once())
            ->method('getList')
            ->with($searchCriteriaMock)
            ->will($this->returnValue($this->expectedResult));

        $result = $this->adapter->getList([$searchCriteriaMock]);

        $this->assertEquals($result, $this->expectedResult);
    }

    public function testGetInputObjectInterfaceName_ShouldReturnString()
    {
        $result = $this->adapter->getInputObjectInterfaceName();
        $this->assertInternalType('string', $result);
    }
}