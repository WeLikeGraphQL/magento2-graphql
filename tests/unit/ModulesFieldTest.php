<?php

namespace graphan\Magento2GraphQL\Test\Unit;

use graphan\Magento2GraphQL\Model\Module\ModulesField;
use Magento\Backend\Service\V1\ModuleServiceInterface;
use Youshido\GraphQL\Execution\ResolveInfo;

class ModulesFieldTest extends \PHPUnit_Framework_TestCase
{
    private $moduleServiceMock;

    public function setUp()
    {
        $this->moduleServiceMock = $this->getMockBuilder(ModuleServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testResolve_ShouldReturnExpectedResult()
    {
        $expectedResult = [];
        $resolveInfoMock = $this->getMockBuilder(ResolveInfo::class)
            ->disableOriginalConstructor()
            ->getMock();
        $field = new ModulesField($this->moduleServiceMock);

        $this->moduleServiceMock->expects($this->once())
            ->method('getModules')
            ->willReturn($expectedResult);

        $result = $field->resolve(null, [], $resolveInfoMock);

        $this->assertEquals($expectedResult, $result);
    }
}