<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program. 
 * https://github.com/swagger-api/swagger-codegen 
 * Do not edit the class manually.
 */

namespace SquareConnect\Api;

use \SquareConnect\Configuration;
use \SquareConnect\ApiClient;
use \SquareConnect\ApiException;
use \SquareConnect\ObjectSerializer;

/**
 * TransactionsApi Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://squareup.com/developers
 */
class TransactionsApi
{

    /**
     * API Client
     * @var \SquareConnect\ApiClient instance of the ApiClient
     */
    protected $apiClient;
  
    /**
     * Constructor
     * @param \SquareConnect\ApiClient|null $apiClient The api client to use
     */
    function __construct($apiClient = null)
    {
        if ($apiClient == null) {
            $apiClient = new ApiClient();
            // $apiClient->getConfig()->setHost('https://connect.squareup.com');
            $apiClient->getConfig()->setHost('https://connect.squareupsandbox.com');
        }
  
        $this->apiClient = $apiClient;
    }
  
    /**
     * Get API client
     * @return \SquareConnect\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }
  
    /**
     * Set the API client
     * @param \SquareConnect\ApiClient $apiClient set the API client
     * @return TransactionsApi
     */
    public function setApiClient(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }
  
    /**
     * @deprecated
     * captureTransaction
     *
     * CaptureTransaction
     *
     * @param string $location_id  (required)
     * @param string $transaction_id  (required)
     * @return \SquareConnect\Model\CaptureTransactionResponse
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function captureTransaction($location_id, $transaction_id)
    {
        trigger_error("\x1B[33mCalling deprecated API: TransactionsApi.captureTransaction\x1B[0m", E_USER_DEPRECATED);
        list($response, $statusCode, $httpHeader) = $this->captureTransactionWithHttpInfo ($location_id, $transaction_id);
        return $response; 
    }


    /**
     * captureTransactionWithHttpInfo
     *
     * CaptureTransaction
     *
     * @param string $location_id  (required)
     * @param string $transaction_id  (required)
     * @return Array of \SquareConnect\Model\CaptureTransactionResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function captureTransactionWithHttpInfo($location_id, $transaction_id)
    {
        
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling captureTransaction');
        }
        // verify the required parameter 'transaction_id' is set
        if ($transaction_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $transaction_id when calling captureTransaction');
        }
  
        // parse inputs
        $resourcePath = "/v2/locations/{location_id}/transactions/{transaction_id}/capture";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array('application/json'));
        $headerParams['Square-Version'] = "2020-05-28";

        
        
        // path params
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "location_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }// path params
        if ($transaction_id !== null) {
            $resourcePath = str_replace(
                "{" . "transaction_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($transaction_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // this endpoint requires OAuth (access token)
        if (strlen($this->apiClient->getConfig()->getAccessToken()) !== 0) {
            $headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'POST',
                $queryParams, $httpBody,
                $headerParams, '\SquareConnect\Model\CaptureTransactionResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array(\SquareConnect\ObjectSerializer::deserialize($response, '\SquareConnect\Model\CaptureTransactionResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = \SquareConnect\ObjectSerializer::deserialize($e->getResponseBody(), '\SquareConnect\Model\CaptureTransactionResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
    /**
     * @deprecated
     * charge
     *
     * Charge
     *
     * @param string $location_id The ID of the location to associate the created transaction with. (required)
     * @param \SquareConnect\Model\ChargeRequest $body An object containing the fields to POST for the request.  See the corresponding object definition for field details. (required)
     * @return \SquareConnect\Model\ChargeResponse
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function charge($location_id, $body)
    {
        trigger_error("\x1B[33mCalling deprecated API: TransactionsApi.charge\x1B[0m", E_USER_DEPRECATED);
        list($response, $statusCode, $httpHeader) = $this->chargeWithHttpInfo ($location_id, $body);
        return $response; 
    }


    /**
     * chargeWithHttpInfo
     *
     * Charge
     *
     * @param string $location_id The ID of the location to associate the created transaction with. (required)
     * @param \SquareConnect\Model\ChargeRequest $body An object containing the fields to POST for the request.  See the corresponding object definition for field details. (required)
     * @return Array of \SquareConnect\Model\ChargeResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function chargeWithHttpInfo($location_id, $body)
    {
        
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling charge');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling charge');
        }
  
        // parse inputs
        $resourcePath = "/v2/locations/{location_id}/transactions";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array('application/json'));
        $headerParams['Square-Version'] = "2020-05-28";

        
        
        // path params
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "location_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // this endpoint requires OAuth (access token)
        if (strlen($this->apiClient->getConfig()->getAccessToken()) !== 0) {
            $headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'POST',
                $queryParams, $httpBody,
                $headerParams, '\SquareConnect\Model\ChargeResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array(\SquareConnect\ObjectSerializer::deserialize($response, '\SquareConnect\Model\ChargeResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = \SquareConnect\ObjectSerializer::deserialize($e->getResponseBody(), '\SquareConnect\Model\ChargeResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
    /**
     * @deprecated
     * createRefund
     *
     * CreateRefund
     *
     * @param string $location_id The ID of the original transaction&#39;s associated location. (required)
     * @param string $transaction_id The ID of the original transaction that includes the tender to refund. (required)
     * @param \SquareConnect\Model\CreateRefundRequest $body An object containing the fields to POST for the request.  See the corresponding object definition for field details. (required)
     * @return \SquareConnect\Model\CreateRefundResponse
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function createRefund($location_id, $transaction_id, $body)
    {
        trigger_error("\x1B[33mCalling deprecated API: TransactionsApi.createRefund\x1B[0m", E_USER_DEPRECATED);
        list($response, $statusCode, $httpHeader) = $this->createRefundWithHttpInfo ($location_id, $transaction_id, $body);
        return $response; 
    }


    /**
     * createRefundWithHttpInfo
     *
     * CreateRefund
     *
     * @param string $location_id The ID of the original transaction&#39;s associated location. (required)
     * @param string $transaction_id The ID of the original transaction that includes the tender to refund. (required)
     * @param \SquareConnect\Model\CreateRefundRequest $body An object containing the fields to POST for the request.  See the corresponding object definition for field details. (required)
     * @return Array of \SquareConnect\Model\CreateRefundResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function createRefundWithHttpInfo($location_id, $transaction_id, $body)
    {
        
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling createRefund');
        }
        // verify the required parameter 'transaction_id' is set
        if ($transaction_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $transaction_id when calling createRefund');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling createRefund');
        }
  
        // parse inputs
        $resourcePath = "/v2/locations/{location_id}/transactions/{transaction_id}/refund";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array('application/json'));
        $headerParams['Square-Version'] = "2020-05-28";

        
        
        // path params
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "location_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }// path params
        if ($transaction_id !== null) {
            $resourcePath = str_replace(
                "{" . "transaction_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($transaction_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // this endpoint requires OAuth (access token)
        if (strlen($this->apiClient->getConfig()->getAccessToken()) !== 0) {
            $headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'POST',
                $queryParams, $httpBody,
                $headerParams, '\SquareConnect\Model\CreateRefundResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array(\SquareConnect\ObjectSerializer::deserialize($response, '\SquareConnect\Model\CreateRefundResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = \SquareConnect\ObjectSerializer::deserialize($e->getResponseBody(), '\SquareConnect\Model\CreateRefundResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
    /**
     * @deprecated
     * listRefunds
     *
     * ListRefunds
     *
     * @param string $location_id The ID of the location to list refunds for. (required)
     * @param string $begin_time The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year. (optional)
     * @param string $end_time The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time. (optional)
     * @param string $sort_order The order in which results are listed in the response (&#x60;ASC&#x60; for oldest first, &#x60;DESC&#x60; for newest first).  Default value: &#x60;DESC&#x60; (optional)
     * @param string $cursor A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Paginating results](#paginatingresults) for more information. (optional)
     * @return \SquareConnect\Model\ListRefundsResponse
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function listRefunds($location_id, $begin_time = null, $end_time = null, $sort_order = null, $cursor = null)
    {
        trigger_error("\x1B[33mCalling deprecated API: TransactionsApi.listRefunds\x1B[0m", E_USER_DEPRECATED);
        list($response, $statusCode, $httpHeader) = $this->listRefundsWithHttpInfo ($location_id, $begin_time, $end_time, $sort_order, $cursor);
        return $response; 
    }


    /**
     * listRefundsWithHttpInfo
     *
     * ListRefunds
     *
     * @param string $location_id The ID of the location to list refunds for. (required)
     * @param string $begin_time The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year. (optional)
     * @param string $end_time The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time. (optional)
     * @param string $sort_order The order in which results are listed in the response (&#x60;ASC&#x60; for oldest first, &#x60;DESC&#x60; for newest first).  Default value: &#x60;DESC&#x60; (optional)
     * @param string $cursor A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Paginating results](#paginatingresults) for more information. (optional)
     * @return Array of \SquareConnect\Model\ListRefundsResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function listRefundsWithHttpInfo($location_id, $begin_time = null, $end_time = null, $sort_order = null, $cursor = null)
    {
        
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling listRefunds');
        }
  
        // parse inputs
        $resourcePath = "/v2/locations/{location_id}/refunds";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array('application/json'));
        $headerParams['Square-Version'] = "2020-05-28";

        // query params
        if ($begin_time !== null) {
            $queryParams['begin_time'] = $this->apiClient->getSerializer()->toQueryValue($begin_time);
        }// query params
        if ($end_time !== null) {
            $queryParams['end_time'] = $this->apiClient->getSerializer()->toQueryValue($end_time);
        }// query params
        if ($sort_order !== null) {
            $queryParams['sort_order'] = $this->apiClient->getSerializer()->toQueryValue($sort_order);
        }// query params
        if ($cursor !== null) {
            $queryParams['cursor'] = $this->apiClient->getSerializer()->toQueryValue($cursor);
        }
        
        // path params
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "location_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // this endpoint requires OAuth (access token)
        if (strlen($this->apiClient->getConfig()->getAccessToken()) !== 0) {
            $headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'GET',
                $queryParams, $httpBody,
                $headerParams, '\SquareConnect\Model\ListRefundsResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array(\SquareConnect\ObjectSerializer::deserialize($response, '\SquareConnect\Model\ListRefundsResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = \SquareConnect\ObjectSerializer::deserialize($e->getResponseBody(), '\SquareConnect\Model\ListRefundsResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
    /**
     * @deprecated
     * listTransactions
     *
     * ListTransactions
     *
     * @param string $location_id The ID of the location to list transactions for. (required)
     * @param string $begin_time The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year. (optional)
     * @param string $end_time The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time. (optional)
     * @param string $sort_order The order in which results are listed in the response (&#x60;ASC&#x60; for oldest first, &#x60;DESC&#x60; for newest first).  Default value: &#x60;DESC&#x60; (optional)
     * @param string $cursor A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Paginating results](#paginatingresults) for more information. (optional)
     * @return \SquareConnect\Model\ListTransactionsResponse
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function listTransactions($location_id, $begin_time = null, $end_time = null, $sort_order = null, $cursor = null)
    {
        trigger_error("\x1B[33mCalling deprecated API: TransactionsApi.listTransactions\x1B[0m", E_USER_DEPRECATED);
        list($response, $statusCode, $httpHeader) = $this->listTransactionsWithHttpInfo ($location_id, $begin_time, $end_time, $sort_order, $cursor);
        return $response; 
    }


    /**
     * listTransactionsWithHttpInfo
     *
     * ListTransactions
     *
     * @param string $location_id The ID of the location to list transactions for. (required)
     * @param string $begin_time The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year. (optional)
     * @param string $end_time The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time. (optional)
     * @param string $sort_order The order in which results are listed in the response (&#x60;ASC&#x60; for oldest first, &#x60;DESC&#x60; for newest first).  Default value: &#x60;DESC&#x60; (optional)
     * @param string $cursor A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Paginating results](#paginatingresults) for more information. (optional)
     * @return Array of \SquareConnect\Model\ListTransactionsResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function listTransactionsWithHttpInfo($location_id, $begin_time = null, $end_time = null, $sort_order = null, $cursor = null)
    {
        
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling listTransactions');
        }
  
        // parse inputs
        $resourcePath = "/v2/locations/{location_id}/transactions";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array('application/json'));
        $headerParams['Square-Version'] = "2020-05-28";

        // query params
        if ($begin_time !== null) {
            $queryParams['begin_time'] = $this->apiClient->getSerializer()->toQueryValue($begin_time);
        }// query params
        if ($end_time !== null) {
            $queryParams['end_time'] = $this->apiClient->getSerializer()->toQueryValue($end_time);
        }// query params
        if ($sort_order !== null) {
            $queryParams['sort_order'] = $this->apiClient->getSerializer()->toQueryValue($sort_order);
        }// query params
        if ($cursor !== null) {
            $queryParams['cursor'] = $this->apiClient->getSerializer()->toQueryValue($cursor);
        }
        
        // path params
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "location_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // this endpoint requires OAuth (access token)
        if (strlen($this->apiClient->getConfig()->getAccessToken()) !== 0) {
            $headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'GET',
                $queryParams, $httpBody,
                $headerParams, '\SquareConnect\Model\ListTransactionsResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array(\SquareConnect\ObjectSerializer::deserialize($response, '\SquareConnect\Model\ListTransactionsResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = \SquareConnect\ObjectSerializer::deserialize($e->getResponseBody(), '\SquareConnect\Model\ListTransactionsResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
    /**
     * @deprecated
     * retrieveTransaction
     *
     * RetrieveTransaction
     *
     * @param string $location_id The ID of the transaction&#39;s associated location. (required)
     * @param string $transaction_id The ID of the transaction to retrieve. (required)
     * @return \SquareConnect\Model\RetrieveTransactionResponse
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function retrieveTransaction($location_id, $transaction_id)
    {
        trigger_error("\x1B[33mCalling deprecated API: TransactionsApi.retrieveTransaction\x1B[0m", E_USER_DEPRECATED);
        list($response, $statusCode, $httpHeader) = $this->retrieveTransactionWithHttpInfo ($location_id, $transaction_id);
        return $response; 
    }


    /**
     * retrieveTransactionWithHttpInfo
     *
     * RetrieveTransaction
     *
     * @param string $location_id The ID of the transaction&#39;s associated location. (required)
     * @param string $transaction_id The ID of the transaction to retrieve. (required)
     * @return Array of \SquareConnect\Model\RetrieveTransactionResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function retrieveTransactionWithHttpInfo($location_id, $transaction_id)
    {
        
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling retrieveTransaction');
        }
        // verify the required parameter 'transaction_id' is set
        if ($transaction_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $transaction_id when calling retrieveTransaction');
        }
  
        // parse inputs
        $resourcePath = "/v2/locations/{location_id}/transactions/{transaction_id}";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array('application/json'));
        $headerParams['Square-Version'] = "2020-05-28";

        
        
        // path params
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "location_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }// path params
        if ($transaction_id !== null) {
            $resourcePath = str_replace(
                "{" . "transaction_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($transaction_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // this endpoint requires OAuth (access token)
        if (strlen($this->apiClient->getConfig()->getAccessToken()) !== 0) {
            $headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'GET',
                $queryParams, $httpBody,
                $headerParams, '\SquareConnect\Model\RetrieveTransactionResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array(\SquareConnect\ObjectSerializer::deserialize($response, '\SquareConnect\Model\RetrieveTransactionResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = \SquareConnect\ObjectSerializer::deserialize($e->getResponseBody(), '\SquareConnect\Model\RetrieveTransactionResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
    /**
     * @deprecated
     * voidTransaction
     *
     * VoidTransaction
     *
     * @param string $location_id  (required)
     * @param string $transaction_id  (required)
     * @return \SquareConnect\Model\VoidTransactionResponse
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function voidTransaction($location_id, $transaction_id)
    {
        trigger_error("\x1B[33mCalling deprecated API: TransactionsApi.voidTransaction\x1B[0m", E_USER_DEPRECATED);
        list($response, $statusCode, $httpHeader) = $this->voidTransactionWithHttpInfo ($location_id, $transaction_id);
        return $response; 
    }


    /**
     * voidTransactionWithHttpInfo
     *
     * VoidTransaction
     *
     * @param string $location_id  (required)
     * @param string $transaction_id  (required)
     * @return Array of \SquareConnect\Model\VoidTransactionResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \SquareConnect\ApiException on non-2xx response
     */
    public function voidTransactionWithHttpInfo($location_id, $transaction_id)
    {
        
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling voidTransaction');
        }
        // verify the required parameter 'transaction_id' is set
        if ($transaction_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $transaction_id when calling voidTransaction');
        }
  
        // parse inputs
        $resourcePath = "/v2/locations/{location_id}/transactions/{transaction_id}/void";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = ApiClient::selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = ApiClient::selectHeaderContentType(array('application/json'));
        $headerParams['Square-Version'] = "2020-05-28";

        
        
        // path params
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "location_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }// path params
        if ($transaction_id !== null) {
            $resourcePath = str_replace(
                "{" . "transaction_id" . "}",
                $this->apiClient->getSerializer()->toPathValue($transaction_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        
        // this endpoint requires OAuth (access token)
        if (strlen($this->apiClient->getConfig()->getAccessToken()) !== 0) {
            $headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'POST',
                $queryParams, $httpBody,
                $headerParams, '\SquareConnect\Model\VoidTransactionResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array(\SquareConnect\ObjectSerializer::deserialize($response, '\SquareConnect\Model\VoidTransactionResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = \SquareConnect\ObjectSerializer::deserialize($e->getResponseBody(), '\SquareConnect\Model\VoidTransactionResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
}
