<?php

namespace BenBorla\JobAdder\V2\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;

class CandidatesResource extends Resource
{
    /**
     * @param array $parameters {
     *
     *     @var int $offset The index of the first entry to return from the resource collection
     *     @var int $limit The maximum number of entries to return. <br />
     *     @var array $candidateId Candidate Id
     *     @var string $name Candidate name
     *     @var string $email Candidate email
     *     @var string $keywords Search for key words within the latest candidate resume
     *     @var array $statusId Candidate status
     *     @var array $recruiterUserId User Id - search candidates by associated recruiters
     *     @var array $createdAt Search for candidates created at a specific date and time
     *     @var array $updatedAt Search for candidates updated at a specific date and time
     * }
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateListRepresentation
     */
    public function findCandidates($parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('offset', null);
        $queryParam->setDefault('limit', null);
        $queryParam->setDefault('candidateId', null);
        $queryParam->setDefault('name', null);
        $queryParam->setDefault('email', null);
        $queryParam->setDefault('keywords', null);
        $queryParam->setDefault('statusId', null);
        $queryParam->setDefault('recruiterUserId', null);
        $queryParam->setDefault('createdAt', null);
        $queryParam->setDefault('updatedAt', null);
        $url     = '/v2/candidates';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param \BenBorla\JobAdder\V2\Model\AddCandidateCommand $body
     * @param array                                           $parameters List of parameters
     * @param string                                          $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateRepresentation|\BenBorla\JobAdder\V2\Model\ErrorModel
     */
    public function addCandidate(\BenBorla\JobAdder\V2\Model\AddCandidateCommand $body, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates';
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json'], 'Content-Type' => 'application/json'], $queryParam->buildHeaders($parameters));
        $body       = $this->serializer->serialize($body, 'json');
        $request    = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('201' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateRepresentation', 'json');
            }
            if ('409' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\ErrorModel', 'json');
            }
            if ('422' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\ErrorModel', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateRepresentation|\BenBorla\JobAdder\V2\Model\ErrorModel
     */
    public function getCandidate($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateRepresentation', 'json');
            }
            if ('404' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\ErrorModel', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int                                                $candidateId
     * @param \BenBorla\JobAdder\V2\Model\UpdateCandidateCommand $body
     * @param array                                              $parameters  List of parameters
     * @param string                                             $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\ErrorModel
     */
    public function updateCandidate($candidateId, \BenBorla\JobAdder\V2\Model\UpdateCandidateCommand $body, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json'], 'Content-Type' => 'application/json'], $queryParam->buildHeaders($parameters));
        $body       = $this->serializer->serialize($body, 'json');
        $request    = $this->messageFactory->createRequest('PUT', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('409' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\ErrorModel', 'json');
            }
            if ('422' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\ErrorModel', 'json');
            }
        }

        return $response;
    }

    /**
     * This will include both active and complete/closed job applications.
     *
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\JobApplicationListRepresentation
     */
    public function getCandidateJobApplications($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/applications';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\JobApplicationListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\JobApplicationListRepresentation
     */
    public function getActiveCandidateJobApplications($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/applications/active';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\JobApplicationListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int   $candidateId
     * @param array $parameters  {
     *
     *     @var int $offset The index of the first entry to return from the resource collection
     *     @var int $limit The maximum number of entries to return. <br />
     *     @var array $type Attachment types to include
     *     @var array $label Search by attachment label
     *     @var bool $latest Find the latest version of each attachment type
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateAttachmentListRepresentation
     */
    public function findCandidateAttachments($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('offset', null);
        $queryParam->setDefault('limit', null);
        $queryParam->setDefault('type', null);
        $queryParam->setDefault('label', null);
        $queryParam->setDefault('latest', null);
        $url     = '/v2/candidates/{candidateId}/attachments';
        $url     = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateAttachmentListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId
     * @param string $attachmentType
     * @param array  $parameters     List of parameters
     * @param string $fetch          Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getLatestCandidateAttachment($candidateId, $attachmentType, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/attachments/{attachmentType}';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = str_replace('{attachmentType}', urlencode($attachmentType), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com'], $queryParam->buildHeaders($parameters));
        $body       = $queryParam->buildFormDataString($parameters);
        $request    = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();

        return $response;
    }

    /**
     * @param int    $candidateId    Candidate Id
     * @param string $attachmentType
     * @param array  $parameters     {
     *
     *     @var  $fileData
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function postCandidateAttachment($candidateId, $attachmentType, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setRequired('fileData');
        $queryParam->setFormParameters(['fileData']);
        $url     = '/v2/candidates/{candidateId}/attachments/{attachmentType}';
        $url     = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url     = str_replace('{attachmentType}', urlencode($attachmentType), $url);
        $url     = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body    = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();

        return $response;
    }

    /**
     * @param int    $candidateId
     * @param string $attachmentType
     * @param int    $attachmentId
     * @param array  $parameters     List of parameters
     * @param string $fetch          Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCandidateAttachment($candidateId, $attachmentType, $attachmentId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/attachments/{attachmentType}/{attachmentId}';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = str_replace('{attachmentType}', urlencode($attachmentType), $url);
        $url        = str_replace('{attachmentId}', urlencode($attachmentId), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com'], $queryParam->buildHeaders($parameters));
        $body       = $queryParam->buildFormDataString($parameters);
        $request    = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteCandidateFormattedResume($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/attachments/formattedresume';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body       = $queryParam->buildFormDataString($parameters);
        $request    = $this->messageFactory->createRequest('DELETE', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();

        return $response;
    }

    /**
     * @param int   $candidateId Candidate Id
     * @param array $parameters  {
     *
     *     @var  $fileData
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function putCandidateFormattedResume($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setRequired('fileData');
        $queryParam->setFormParameters(['fileData']);
        $url     = '/v2/candidates/{candidateId}/attachments/formattedresume';
        $url     = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url     = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body    = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('PUT', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\FloatListRepresentation
     */
    public function getCandidateFloats($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/floats';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\FloatListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int   $candidateId Candidate Id
     * @param array $parameters  {
     *
     *     @var array $include Include related notes
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\NoteListRepresentation
     */
    public function getCandidateNotes($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('include', null);
        $url     = '/v2/candidates/{candidateId}/notes';
        $url     = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\NoteListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int                                                 $candidateId
     * @param \BenBorla\JobAdder\V2\Model\AddCandidateNoteCommand $body
     * @param array                                               $parameters  List of parameters
     * @param string                                              $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\NoteModel
     */
    public function addCandidateNote($candidateId, \BenBorla\JobAdder\V2\Model\AddCandidateNoteCommand $body, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/notes';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json'], 'Content-Type' => 'application/json'], $queryParam->buildHeaders($parameters));
        $body       = $this->serializer->serialize($body, 'json');
        $request    = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('201' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\NoteModel', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteCandidatePhoto($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/photo';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body       = $queryParam->buildFormDataString($parameters);
        $request    = $this->messageFactory->createRequest('DELETE', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCandidatePhoto($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/photo';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com'], $queryParam->buildHeaders($parameters));
        $body       = $queryParam->buildFormDataString($parameters);
        $request    = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();

        return $response;
    }

    /**
     * @param int   $candidateId Candidate Id
     * @param array $parameters  {
     *
     *     @var  $fileData
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateCandidatePhoto($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setRequired('fileData');
        $queryParam->setFormParameters(['fileData']);
        $url     = '/v2/candidates/{candidateId}/photo';
        $url     = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url     = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body    = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('PUT', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\PlacementListRepresentation
     */
    public function getCandidatePlacements($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/placements';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\PlacementListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\PlacementListRepresentation
     */
    public function getCandidateApprovedPlacements($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/placements/approved';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\PlacementListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CategoryListRepresentation
     */
    public function getCandidateSkills($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/skills';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CategoryListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId Candidate Id
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\SubmissionListRepresentation
     */
    public function getCandidateSubmissions($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/submissions';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\SubmissionListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateVideoListRepresentation
     */
    public function getCandidateVideos($candidateId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/videos';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateVideoListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $candidateId
     * @param string $videoType
     * @param array  $parameters  List of parameters
     * @param string $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateVideoRepresentation
     */
    public function getLatestCandidateVideo($candidateId, $videoType, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/videos/{videoType}';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = str_replace('{videoType}', urlencode($videoType), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateVideoRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int                                                  $candidateId Candidate Id
     * @param string                                               $videoType
     * @param \BenBorla\JobAdder\V2\Model\AddCandidateVideoCommand $body
     * @param array                                                $parameters  List of parameters
     * @param string                                               $fetch       Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateVideoModel
     */
    public function addCandidateVideo($candidateId, $videoType, \BenBorla\JobAdder\V2\Model\AddCandidateVideoCommand $body, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/{candidateId}/videos/{videoType}';
        $url        = str_replace('{candidateId}', urlencode($candidateId), $url);
        $url        = str_replace('{videoType}', urlencode($videoType), $url);
        $url        = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers    = array_merge(['Host' => 'api.jobadder.com', 'Accept' => ['application/json'], 'Content-Type' => 'application/json'], $queryParam->buildHeaders($parameters));
        $body       = $this->serializer->serialize($body, 'json');
        $request    = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise    = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('200' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateVideoModel', 'json');
            }
        }

        return $response;
    }

    /**
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CustomFieldListRepresentation
     */
    public function getCandidateCustomFieldList($parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/fields/custom';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CustomFieldListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $fieldId
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CustomFieldRepresentation
     */
    public function getCandidateCustomFieldListItem($fieldId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/fields/custom/{fieldId}';
        $url        = str_replace('{fieldId}', urlencode($fieldId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CustomFieldRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param array $parameters {
     *
     *     @var string $name
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\NoteTypeListRepresentation
     */
    public function getCandidateNoteTypeList($parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('name', null);
        $url     = '/v2/candidates/lists/notetype';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\NoteTypeListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param array $parameters {
     *
     *     @var string $name
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateRatingListRepresentation
     */
    public function getCandidateRatingList($parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('name', null);
        $url     = '/v2/candidates/lists/rating';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateRatingListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param array $parameters {
     *
     *     @var string $name
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\SalutationListRepresentation
     */
    public function getCandidateSalutationList($parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('name', null);
        $url     = '/v2/candidates/lists/salutation';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\SalutationListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param array $parameters {
     *
     *     @var string $name
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\CandidateSourceListRepresentation
     */
    public function getCandidateSourceList($parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('name', null);
        $url     = '/v2/candidates/lists/source';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\CandidateSourceListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param array $parameters {
     *
     *     @var array $statusId
     *     @var string $name
     *     @var bool $active
     *     @var bool $default
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\StatusListRepresentation
     */
    public function getCandidateStatusList($parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('statusId', null);
        $queryParam->setDefault('name', null);
        $queryParam->setDefault('active', null);
        $queryParam->setDefault('default', null);
        $url     = '/v2/candidates/lists/status';
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\StatusListRepresentation', 'json');
            }
        }

        return $response;
    }

    /**
     * @param int    $statusId
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\BenBorla\JobAdder\V2\Model\StatusRepresentation
     */
    public function getCandidateStatusListItem($statusId, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $url        = '/v2/candidates/lists/status/{statusId}';
        $url        = str_replace('{statusId}', urlencode($statusId), $url);
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
                return $this->serializer->deserialize((string) $response->getBody(), 'BenBorla\\JobAdder\\V2\\Model\\StatusRepresentation', 'json');
            }
        }

        return $response;
    }
}
