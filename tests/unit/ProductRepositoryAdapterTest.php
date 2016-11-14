<?php

namespace graphan\Magento2GraphQL\Test\Unit;


use graphan\Magento2GraphQL\Plugin\ProductAttributeRepositoryPlugin;
use graphan\Magento2GraphQL\Model\Product\ProductRepositoryAdapter;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Parser\Ast\Query;

class ProductRepositoryAdapterTest extends \PHPUnit_Framework_TestCase
{
    private $productRepoMock;
    private $productRepoAdapter;
    private $productMock;
    private $plugin;
    private $expectedResult;

    public function setUp()
    {
        $this->productMock = $this->getMockBuilder(ProductInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productRepoMock = $this->getMockBuilder(ProductRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = $this->getMockBuilder(ProductAttributeRepositoryPlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productRepoAdapter = new ProductRepositoryAdapter($this->productRepoMock, $this->plugin);

        $this->expectedResult = 'result';
    }

    public function testGet_ShouldReturnExpectedResult()
    {
        $param = 'attr_code';

        $this->productRepoMock->expects($this->once())
            ->method('get')
            ->with($param)
            ->willReturn($this->expectedResult);

        $result = $this->productRepoAdapter->get([$param]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testGetList_ShouldReturnExpectedResult()
    {
        $searchCriteriaMock = $this->getMockBuilder(SearchCriteriaInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $resolveInfoMock = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $queryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productRepoMock->expects($this->once())
            ->method('getList')
            ->with($searchCriteriaMock)
            ->willReturn($this->expectedResult);

        $resolveInfoMock->expects($this->once())
            ->method('getFieldASTList')
            ->willReturn([$queryMock]);

        $queryMock->expects($this->once())
            ->method('getFields')
            ->willReturn($queryMock);

        $this->plugin->expects($this->once())
            ->method('setFields')
            ->with($queryMock);

        $result = $this->productRepoAdapter->getList([$searchCriteriaMock], $resolveInfoMock);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testDelete_ShouldReturnExpectedResult()
    {
        $id = 1;

        $this->productRepoMock->expects($this->once())
            ->method('deleteById')
            ->with($id)
            ->willReturn($this->expectedResult);

        $result = $this->productRepoAdapter->delete([$id]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testSave_ShouldReturnExpectedResult()
    {
        $this->productRepoMock->expects($this->once())
            ->method('save')
            ->with($this->productMock)
            ->willReturn($this->expectedResult);

        $result = $this->productRepoAdapter->save([$this->productMock]);

        $this->assertEquals($this->expectedResult, $result);
    }

    public function testGetInputObjectInterfaceName_ShouldReturnString()
    {
        $result = $this->productRepoAdapter->getInputObjectInterfaceName();
        $this->assertInternalType('string', $result);
    }
}