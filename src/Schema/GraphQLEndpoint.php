<?php

namespace graphan\Magento2GraphQL\Schema;

use graphan\Magento2GraphQL\Api\GraphQLEndpointInterface;
use Youshido\GraphQL\Execution\Processor;
use Youshido\GraphQL\Schema\AbstractSchema;

/**
 * @codeCoverageIgnore
 */
class GraphQLEndpoint implements GraphQLEndpointInterface
{
    private $schema;

    public function __construct(AbstractSchema $schema)
    {
        $this->schema = $schema;
    }

    /**
     * {@inheritdoc}
     */
    public function parseQuery($query)
    {
        $result = null;

        try {
            $processor = new Processor($this->schema);
            $processor->processPayload($query);
            $result = $processor->getResponseData();
        } catch (\Exception $exception) {
            $result = [
                'errors' => [
                    ['message' => $exception->getMessage()]
                ]
            ];
        }

        return $result;
    }
}