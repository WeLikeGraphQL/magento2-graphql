<?php

namespace graphan\Magento2GraphQL\Test\Unit;


use graphan\Magento2GraphQL\Model\Search\SearchType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

class SearchTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName_ShouldReturnNameWithS()
    {
        $expectedResult = 'names';

        $responseTypeMock = $this->getMockBuilder(AbstractObjectType::class)
            ->setMethods(['getName'])
            ->getMockForAbstractClass();

        $searchType = new SearchType($responseTypeMock);

        $responseTypeMock->expects($this->once())
            ->method('getName')
            ->willReturn('name');

        $result = $searchType->getName();

        $this->assertEquals($expectedResult, $result);
    }
}