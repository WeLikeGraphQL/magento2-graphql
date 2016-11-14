<?php
namespace graphan\Magento2GraphQL;

use graphan\Magento2GraphQL\Api\GraphQLEndpointInterface;
use Magento\Framework\App\AreaList;
use Magento\Framework\App\FrontControllerInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\HTTP\PhpEnvironment\Request as HttpRequest;

/**
 * Front controller for the 'alexa' area. Converts web service requests
 * (HTTP POST of JSON encoded data) into appropriate PHP function calls
 * defined in AlexaApplicationInterface.
 */
class FrontController implements FrontControllerInterface
{
    /** @var ResultFactory */
    private $resultFactory;
    /** @var GraphQLInterface  */
    private $endpoint;

    /**
     * FrontController constructor.
     * @param GraphQLInterface $endpoint
     * @param ResultFactory $resultFactory
     */
    public function __construct(
        GraphQLEndpointInterface $endpoint,
        ResultFactory $resultFactory
    ) {
        $this->endpoint = $endpoint;
        $this->resultFactory = $resultFactory;
    }

    public function dispatch(RequestInterface $request)
    {
        /** @var HttpRequest $req */
        $req = $request;
        try {
            $query = $this->getQuery($req);
            $parsedQuery = $this->endpoint->parseQuery($query);

            return $this->getJsonResult($query, $parsedQuery);
        } catch (\Exception $exception) {
            return $this->getJsonExceptionResult($exception);
        }
    }

    private function getQuery(HttpRequest $req)
    {
        return $this->decodeJson($req)['query'];
    }

    private function decodeJson(HttpRequest $req)
    {
        return json_decode($req->getContent(), true);
    }

    private function getJsonResult($query, $parsedQuery)
    {
        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $result->setHttpResponseCode(200);
        $result->setHeader('Content-Type', 'application/json', true);

        if(strpos($query, 'IntrospectionQuery') !== false || !isset($parsedQuery['data'])) {
            $result->setData($parsedQuery);
        }
        else {
            $result->setData($parsedQuery['data']);
        }

        return $result;
    }

    private function getJsonExceptionResult(\Exception $exception)
    {
        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setHttpResponseCode($exception->getCode() >= 200 ? $exception->getCode() : 500);
        $result->setHeader('Content-Type', 'text/plain', true);
        $result->setContents($exception->getMessage());
        return $result;
    }
}