<?php

namespace graphan\Magento2GraphQL\Api;

interface GraphQLEndpointInterface
{
    /**
     * Return parsed query sent to GraphQL Parser
     *
     * @api
     * @param string $query
     * @return mixed
     */
    public function parseQuery($query);
}