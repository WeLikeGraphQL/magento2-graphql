<?php

namespace graphan\Magento2GraphQL\Test\Unit;


use graphan\Magento2GraphQL\Model\Product\Attribute\ProductAttributeRepositoryAdapter;
use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class ProductAttributeRepositoryAdapterTest extends \PHPUnit_Framework_TestCase
{
    private $productAttributeRepoMock;
    private $productAttributeRepoAdapter;
    private $productAttributeMock;
    private $expectedResult;

    public function setUp()
    {
        $this->productAttributeMock = $this->getMockBuilder(ProductAttributeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAttributeRepoMock = $this->getMockBuilder(ProductAttributeRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAttributeRepoAdapter = new ProductAttributeRepositoryAdapter($this->productAttributeRepoMock);

        $this->expectedResult = 'result';
    }

    public function testGet_ShouldReturnExpectedResult()
    {
        $param = 'attr_code';

        $this->productAttributeRepoMock->expects($this->once())
            ->method('get')
            ->with($param)
            ->willReturn($this->expectedResult);

        $result = $this->productAttributeRepoAdapter->get([$param]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testGetList_ShouldReturnExpectedResult()
    {
        $searchCriteriaMock = $this->getMockBuilder(SearchCriteriaInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAttributeRepoMock->expects($this->once())
            ->method('getList')
            ->with($searchCriteriaMock)
            ->willReturn($this->expectedResult);

        $result = $this->productAttributeRepoAdapter->getList([$searchCriteriaMock]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testDelete_ShouldReturnExpectedResult()
    {
        $id = 1;

        $this->productAttributeRepoMock->expects($this->once())
            ->method('deleteById')
            ->with($id)
            ->willReturn($this->expectedResult);

        $result = $this->productAttributeRepoAdapter->delete([$id]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testSave_ShouldReturnExpectedResult()
    {
        $this->productAttributeRepoMock->expects($this->once())
            ->method('save')
            ->with($this->productAttributeMock)
            ->willReturn($this->expectedResult);

        $result = $this->productAttributeRepoAdapter->save([$this->productAttributeMock]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testGetInputObjectInterfaceName_ShouldReturnString()
    {
        $result = $this->productAttributeRepoAdapter->getInputObjectInterfaceName();
        $this->assertInternalType('string', $result);
    }
}