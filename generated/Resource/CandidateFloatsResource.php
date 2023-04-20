<?php

namespace BenBorla\JobAdder\V2\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;

class CandidateFloatsResource extends Resource
{
    /**
     * @param array $parameters {
     *
     *     @var int $offset The index of the first entry to return from the resource collection
     *     @var int $limit The maximum number of entries to return. <br />
     *     @var array $floatId Float Id
     *     @var array $candidateId Candidate Id
     *     @var array $companyId Company Id
     *     @var array $createdAt Search for floats created at a specific date and time
     *     @var array $updatedAt Search for floats updated at a specific date and time
     * }
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\FloatListRepresentation
     */
    public function getFloats($parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('offset', null);
        $queryParam->setDefault('limit', null);
        $queryParam->setDefault('floatId', null);
        $queryParam->setDefault('candidateId', null);
        $queryParam->setDefault('companyId', null);
        $queryParam->setDefault('createdAt', null);
        $queryParam->setDefault('updatedAt', null);
        $url     = '/v2/floats';
        $url     = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body    = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('200' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\FloatListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $floatId
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\FloatRepresentation
     */
    public function getFloat($floatId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/floats/{floatId}';
        $url        = str_replace('{floatId}', urlencode($floatId), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body       = $queryParam->buildFormDataString($parameters);
        $request    = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('200' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\FloatRepresentation', 'json');
            }
        }

        return $response;
    }
}
