<?php

namespace graphan\Magento2GraphQL\Test\Unit;


use graphan\Magento2GraphQL\Api\GraphQLEndpointInterface;
use graphan\Magento2GraphQL\FrontController;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;

class FrontControllerTest extends \PHPUnit_Framework_TestCase
{
    private $graphQLEndpointMock;
    private $resultFactoryMock;
    private $requestMock;
    private $jsonMock;
    private $rawMock;
    private $frontController;

    public function setUp()
    {
        $this->mockDependencies();

        $this->frontController = new FrontController($this->graphQLEndpointMock, $this->resultFactoryMock);
    }

    public function testDispatch_WhenValidJsonReceived_ShouldPassQueryFieldToGraphQLEndpoint()
    {
        $this->mockJsonResultFactory();

        $this->requestMock->expects($this->once())
            ->method('getContent')
            ->willReturn('{"query": "asd"}');

        $this->graphQLEndpointMock->expects($this->once())
            ->method('parseQuery')
            ->with('asd');

        $this->invokeMethod();
    }

    public function testDispatch_WhenValidJsonReceived_ShouldSetCorrectHeaders()
    {
        $this->mockJsonResultFactory();

        $this->requestMock->expects($this->once())
            ->method('getContent')
            ->willReturn('{"query": "asd"}');

        $this->jsonMock->expects($this->once())
            ->method('setHttpResponseCode')
            ->with(200);

        $this->jsonMock->expects($this->once())
            ->method('setHeader')
            ->with('Content-Type', 'application/json', true);

        $this->invokeMethod();
    }

    public function testDispatch_WhenIntrospectionQuery_ShouldSetCorrectData()
    {
        $this->mockJsonResultFactory();

        $data = ['config' => 'someConfig'];

        $this->requestMock->expects($this->once())
            ->method('getContent')
            ->willReturn('{"query": "IntrospectionQuery"}');

        $this->graphQLEndpointMock->expects($this->once())
            ->method('parseQuery')
            ->with('IntrospectionQuery')
            ->willReturn($data);

        $this->jsonMock->expects($this->once())
            ->method('setData')
            ->with($data);

        $this->invokeMethod();
    }

    public function testDispatch_WhenMutation_ShouldSetCorrectData()
    {
        $this->mockJsonResultFactory();

        $data = ['mutation' => 'someMutation'];

        $this->requestMock->expects($this->once())
            ->method('getContent')
            ->willReturn('{"query": "mutation"}');

        $this->graphQLEndpointMock->expects($this->once())
            ->method('parseQuery')
            ->with('mutation')
            ->willReturn($data);

        $this->jsonMock->expects($this->once())
            ->method('setData')
            ->with($data);

        $this->invokeMethod();
    }

    public function testDispatch_WhenQuery_ShouldSetDataWithoutDataAttribute()
    {
        $this->mockJsonResultFactory();

        $data = ['data' => 'someData'];

        $this->requestMock->expects($this->once())
            ->method('getContent')
            ->willReturn('{"query": "anyQuery"}');

        $this->graphQLEndpointMock->expects($this->once())
            ->method('parseQuery')
            ->with('anyQuery')
            ->willReturn($data);

        $this->jsonMock->expects($this->once())
            ->method('setData')
            ->with('someData');

        $this->invokeMethod();
    }

    public function testDispatch_WhenException_ShouldSetCorrectExceptionResult()
    {
        $this->invokeExceptionAndMockRawResultFactory();

        $this->rawMock->expects($this->once())
            ->method('setHttpResponseCode')
            ->with($this->greaterThan(200));

        $this->rawMock->expects($this->once())
            ->method('setHeader')
            ->with('Content-Type', 'text/plain', true);

        $this->invokeMethod();
    }

    public function testDispatch_WhenException_ShouldReturnJson()
    {
        $this->invokeExceptionAndMockRawResultFactory();

        $this->assertEquals($this->rawMock, $this->invokeMethod());
    }

    public function testDispatch_WhenNoException_ShouldReturnJson()
    {
        $this->mockJsonResultFactory();

        $result = $this->frontController->dispatch($this->requestMock);

        $this->assertEquals($this->jsonMock, $result);
    }

    private function mockDependencies()
    {
        $this->graphQLEndpointMock = $this->getMockBuilder(GraphQLEndpointInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resultFactoryMock = $this->getMockBuilder(ResultFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jsonMock = $this->getMockBuilder(Json::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->rawMock = $this->getMockBuilder(Raw::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function mockJsonResultFactory()
    {
        $this->resultFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($this->jsonMock);
    }

    private function invokeExceptionAndMockRawResultFactory()
    {
        $this->requestMock->expects($this->once())
            ->method('getContent')
            ->willReturn('{"field": "anyQuery"}');

        $this->resultFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($this->rawMock);
    }

    private function invokeMethod()
    {
        return $this->frontController->dispatch($this->requestMock);
    }
}