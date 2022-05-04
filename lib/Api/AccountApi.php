<?php
/**
 * AccountApi
 * PHP version 7.3
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * TradingView REST API Specification for Brokers
 *
 * ## Overview   This API is to be implemented by the Brokers in order to connect their backend systems to TradingView, that acts as a frontend.    Check the [info page](https://www.tradingview.com/brokerage-integration/) for more info and use the contact form there if you have any questions.    ### Types of requests   There are two types of requests — client and server.   Client requests are executed at the browser. Server requests are initiated from the TradingView servers.   If your integration does not imply brokerage data stream connection to the TradingView website -   then there won't be any server requests.    #### Clients requests   From the browser TradingView requests the info (list of orders and positions, balance info, etc.) from the broker’s server.   The requests are sent periodically and the intervals can be set by using the [/config](#operation/getConfiguration) endpoint.   After that, TradingView compares the new data with the previous answer and calculates the difference.   If the status of the order/position changes or new data appears - the user will see a notification and the changes   will display in the Account manager on the website.    Requests to the [endpoints](/rest-api-spec/#tag/Trading) for placing/modifying orders, positions closing, etc. occur only after actions made by the user.    The [/quotes](#operation/getQuotes) endpoint retrieves the current bid/ask from the broker.   The [/depth](#operation/getDepth) endpoint retrieves Level 2 market data.    #### Server requests   In case if a Broker provides any Forex or CFD trading access for its clients it will require connection   of its own market data at TradingView. In order to make it possible, you will need to implement the following endpoints -     [/symbol_info](#operation/getSymbolInfo), [/history](#operation/getHistory) and [/streaming](#operation/streaming).   Data requests are sent from different TradingView servers. Usually, at least 4 servers are used.   The historical data is cached on TradingView servers and loaded to the client browser from our servers.    ### Restricting access to data   By default, the broker symbols will be available in the symbol search at TradingView and all the community   will have access to your data streams without any limitation. In order to limit the access to your data streams   please use the following endpoints - [/groups](#operation/getGroups) and [/permissions](#operation/getPermissions).    You can find more information about restricting access to the data in the description of these endpoints.    ### Change log   1.3.27. Added `hardToBorrow`, `notShortable`, `halted` parameters to the [/quotes](#operation/getQuotes) endpoint.    1.3.26. In [/symbol_info](#operation/getSymbolInfo), the `minmov2` property renamed to `minmovement2`, the `Etc/UTC`     timezone added. In [/history ](#operation/getHistory), the `HistoryNextBarResponse` response changed to     `HistoryEmptyBarResponse`, the `countback` query parameter became deprecated.     In [/accounts](#operation/getAccounts), added the `isVerified` property.    1.3.25. Added `locale` parameter to the [/authorize](#operation/authorize) endpoint.    1.3.24. Added leverage support. Added new `supportLeverage` flag. Added three new endpoints:     [/getLeverage](#operation/getLeverage), [/setLeverage](#operation/setLeverage) and [/previewLeverage](#operation/previewLeverage).    1.3.23. Changed description of `forceUserEnterInitialValue` flag in the `OrderDialogCustomFields` parameters.    1.3.22. Added new flags - `supportModifyOrderPrice` and `supportModifyBrackets`. The `supportModifyOrder` flag became deprecated.    1.3.21. Added new `units` field to the [/instruments](#operation/getInstruments) endpoint.    1.3.20. Added new `supportTrailingStop` flag. Added support for trailing stops for orders and positions.    1.3.19. Added new `logout` endpoint, `supportLogout` flag.    1.3.18. Added new `supportPartialClosePosition` flag and `amount` field to the [/closePosition](#operation/closePosition)     endpoint parameters.    1.3.17. Added `stopPercent` and `limitPercent` validation rules to the [/instruments](#operation/getInstruments) endpoint.    1.3.16. Added new `supportOrderHistoryCustomFields` flag and `orderHistoryCustomFields` field to the `ui` object     in the [/accounts](#operation/getAccounts) endpoint and [/config](#operation/getConfiguration).    1.3.15. Added `supportedOrderTypes` field to the `Duration` parameters.    1.3.14. Added `isCapitalize` field to the `positionCustomFields` and `orderCustomFields` parameters.    1.3.13. Added rules parameter to the [/instruments](#operation/getInstruments) endpoint.    1.3.12. Added `prefix` field to the `Account` parameters.    1.3.11. Changed description for [/placeOrder](#operation/placeOrder), [/modifyOrder](#operation/modifyOrder),     [/previewOrder](#operation/previewOrder), `OrderDialogCustomFields` and `customFields` field in `OrderCommon`.    1.3.10. Added `locale` query parameter to [/getOrders](#operation/getOrders), [/placeOrder](#operation/placeOrder),     [/modifyOrder](#operation/modifyOrder), [/cancelOrder](#operation/cancelOrder), [/getPositions](#operation/getPositions),     [/modifyPosition](#operation/modifyPosition), [/closePosition](#operation/closePosition),     [/getExecutions](#operation/getExecutions), [/getOrdersHistory](#operation/getOrdersHistory),     [/getQuotes](#operation/getQuotes), [/getDepth](#operation/getDepth) and [/getBalances](#operation/getBalances) endpoints.    1.3.9. Added `orderId`, `isClose`, `positionId` and `commission` fields to Execution.    1.3.8. Added `id` field to the [/previewOrder](#operation/previewOrder) endpoint parameters.    1.3.7. Added `mutable` field to the `OrderDialogCustomFields` parameters.    1.3.6. Added `lang` query parameter to OAuth authorization request.    1.3.5. Added `accountId` query parameter to `depth` endpoint.    1.3.4. Added Order dialog customization opportunity on the instrument basis. Moved `OrderDialogCustomFields` to     the `ui` object in the [/accounts](#operation/getAccounts) endpoint.    1.3.3. Added new `supportStopOrdersInBothDirections` flag.    1.3.2. Added new `previewOrder` endpoint, `supportPlaceOrderPreview` and `supportModifyOrderPreview ` flags.    1.3.1. Added OAuth 2 Code Flow.    1.3.0. Added overriding Account manager and Durations configuration on Account basis.    1.2.5. Added `reserved`, `value` and `valueCurrency` fields to Crypto Balances.    1.2.4. Added default values to the account flags. Added `supportMarketBrackets` account flag.    1.2.3. Added current ask/bid fields to the parameters of the order [placement](#operation/placeOrder)   and [modification](#operation/modifyPosition) requests.    1.2.2. Added supportPartialOrderExecution flag.    1.2.1. Added support for position's and order's Custom fields. Removed `fixedWidth` and `sortable` fields from `AccountManagerColumn`.    1.2.0. Introducing new Quote response. Deprecation of streaming Bid and Ask responses.   All new integrations should use the Quote response to provide ask/bid values.   Added supportMarketOrders, supportLimitOrders, supportStop orders account flags.   Added informational message to order and position.    1.1.3. Added support for reverse of the position.    1.1.2. Added support for custom Account Summary Row.    1.1.1. Added `type` field to [/accounts](#operation/getAccounts) endpoint.    1.1.0. Refactor, added examples.
 *
 * The version of the OpenAPI document: 1.3.27
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;

/**
 * AccountApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class AccountApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getAccounts
     *
     * Accounts
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfAccountResponseErrorResponse
     */
    public function getAccounts($locale)
    {
        list($response) = $this->getAccountsWithHttpInfo($locale);
        return $response;
    }

    /**
     * Operation getAccountsWithHttpInfo
     *
     * Accounts
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfAccountResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAccountsWithHttpInfo($locale)
    {
        $request = $this->getAccountsRequest($locale);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfAccountResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfAccountResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfAccountResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfAccountResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getAccountsAsync
     *
     * Accounts
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAccountsAsync($locale)
    {
        return $this->getAccountsAsyncWithHttpInfo($locale)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getAccountsAsyncWithHttpInfo
     *
     * Accounts
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getAccountsAsyncWithHttpInfo($locale)
    {
        $returnType = 'OneOfAccountResponseErrorResponse';
        $request = $this->getAccountsRequest($locale);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getAccounts'
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getAccountsRequest($locale)
    {
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getAccounts'
            );
        }

        $resourcePath = '/accounts';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getBalances
     *
     * Balances
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfCryptoBalancesResponseErrorResponse
     */
    public function getBalances($account_id, $locale)
    {
        list($response) = $this->getBalancesWithHttpInfo($account_id, $locale);
        return $response;
    }

    /**
     * Operation getBalancesWithHttpInfo
     *
     * Balances
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfCryptoBalancesResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getBalancesWithHttpInfo($account_id, $locale)
    {
        $request = $this->getBalancesRequest($account_id, $locale);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfCryptoBalancesResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfCryptoBalancesResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfCryptoBalancesResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfCryptoBalancesResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getBalancesAsync
     *
     * Balances
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBalancesAsync($account_id, $locale)
    {
        return $this->getBalancesAsyncWithHttpInfo($account_id, $locale)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getBalancesAsyncWithHttpInfo
     *
     * Balances
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBalancesAsyncWithHttpInfo($account_id, $locale)
    {
        $returnType = 'OneOfCryptoBalancesResponseErrorResponse';
        $request = $this->getBalancesRequest($account_id, $locale);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getBalances'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getBalancesRequest($account_id, $locale)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getBalances'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getBalances'
            );
        }

        $resourcePath = '/accounts/{accountId}/balances';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getExecutions
     *
     * Executions
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  float $max_count Maximum count of executions to return. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfExecutionsResponseErrorResponse
     */
    public function getExecutions($account_id, $locale, $instrument, $max_count = null)
    {
        list($response) = $this->getExecutionsWithHttpInfo($account_id, $locale, $instrument, $max_count);
        return $response;
    }

    /**
     * Operation getExecutionsWithHttpInfo
     *
     * Executions
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  float $max_count Maximum count of executions to return. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfExecutionsResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getExecutionsWithHttpInfo($account_id, $locale, $instrument, $max_count = null)
    {
        $request = $this->getExecutionsRequest($account_id, $locale, $instrument, $max_count);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfExecutionsResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfExecutionsResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfExecutionsResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfExecutionsResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getExecutionsAsync
     *
     * Executions
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  float $max_count Maximum count of executions to return. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getExecutionsAsync($account_id, $locale, $instrument, $max_count = null)
    {
        return $this->getExecutionsAsyncWithHttpInfo($account_id, $locale, $instrument, $max_count)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getExecutionsAsyncWithHttpInfo
     *
     * Executions
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  float $max_count Maximum count of executions to return. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getExecutionsAsyncWithHttpInfo($account_id, $locale, $instrument, $max_count = null)
    {
        $returnType = 'OneOfExecutionsResponseErrorResponse';
        $request = $this->getExecutionsRequest($account_id, $locale, $instrument, $max_count);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getExecutions'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  float $max_count Maximum count of executions to return. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getExecutionsRequest($account_id, $locale, $instrument, $max_count = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getExecutions'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getExecutions'
            );
        }
        // verify the required parameter 'instrument' is set
        if ($instrument === null || (is_array($instrument) && count($instrument) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instrument when calling getExecutions'
            );
        }

        $resourcePath = '/accounts/{accountId}/executions';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }
        // query params
        if ($instrument !== null) {
            if('form' === 'form' && is_array($instrument)) {
                foreach($instrument as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['instrument'] = $instrument;
            }
        }
        // query params
        if ($max_count !== null) {
            if('form' === 'form' && is_array($max_count)) {
                foreach($max_count as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['maxCount'] = $max_count;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getInstruments
     *
     * Instruments
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfInstrumentsResponseErrorResponse
     */
    public function getInstruments($account_id, $locale)
    {
        list($response) = $this->getInstrumentsWithHttpInfo($account_id, $locale);
        return $response;
    }

    /**
     * Operation getInstrumentsWithHttpInfo
     *
     * Instruments
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfInstrumentsResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getInstrumentsWithHttpInfo($account_id, $locale)
    {
        $request = $this->getInstrumentsRequest($account_id, $locale);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfInstrumentsResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfInstrumentsResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfInstrumentsResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfInstrumentsResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getInstrumentsAsync
     *
     * Instruments
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getInstrumentsAsync($account_id, $locale)
    {
        return $this->getInstrumentsAsyncWithHttpInfo($account_id, $locale)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getInstrumentsAsyncWithHttpInfo
     *
     * Instruments
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getInstrumentsAsyncWithHttpInfo($account_id, $locale)
    {
        $returnType = 'OneOfInstrumentsResponseErrorResponse';
        $request = $this->getInstrumentsRequest($account_id, $locale);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getInstruments'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getInstrumentsRequest($account_id, $locale)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getInstruments'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getInstruments'
            );
        }

        $resourcePath = '/accounts/{accountId}/instruments';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getLeverage
     *
     * Get Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfGetLeverageResponseErrorResponse
     */
    public function getLeverage($account_id, $locale, $instrument, $side, $order_type)
    {
        list($response) = $this->getLeverageWithHttpInfo($account_id, $locale, $instrument, $side, $order_type);
        return $response;
    }

    /**
     * Operation getLeverageWithHttpInfo
     *
     * Get Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfGetLeverageResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLeverageWithHttpInfo($account_id, $locale, $instrument, $side, $order_type)
    {
        $request = $this->getLeverageRequest($account_id, $locale, $instrument, $side, $order_type);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfGetLeverageResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfGetLeverageResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfGetLeverageResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfGetLeverageResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLeverageAsync
     *
     * Get Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLeverageAsync($account_id, $locale, $instrument, $side, $order_type)
    {
        return $this->getLeverageAsyncWithHttpInfo($account_id, $locale, $instrument, $side, $order_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLeverageAsyncWithHttpInfo
     *
     * Get Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLeverageAsyncWithHttpInfo($account_id, $locale, $instrument, $side, $order_type)
    {
        $returnType = 'OneOfGetLeverageResponseErrorResponse';
        $request = $this->getLeverageRequest($account_id, $locale, $instrument, $side, $order_type);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getLeverage'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLeverageRequest($account_id, $locale, $instrument, $side, $order_type)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getLeverage'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getLeverage'
            );
        }
        // verify the required parameter 'instrument' is set
        if ($instrument === null || (is_array($instrument) && count($instrument) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instrument when calling getLeverage'
            );
        }
        // verify the required parameter 'side' is set
        if ($side === null || (is_array($side) && count($side) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $side when calling getLeverage'
            );
        }
        // verify the required parameter 'order_type' is set
        if ($order_type === null || (is_array($order_type) && count($order_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_type when calling getLeverage'
            );
        }

        $resourcePath = '/accounts/{accountId}/getLeverage';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }

        // form params
        if ($instrument !== null) {
            $formParams['instrument'] = ObjectSerializer::toFormValue($instrument);
        }
        // form params
        if ($side !== null) {
            $formParams['side'] = ObjectSerializer::toFormValue($side);
        }
        // form params
        if ($order_type !== null) {
            $formParams['orderType'] = ObjectSerializer::toFormValue($order_type);
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/x-www-form-urlencoded']
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getOrders
     *
     * Orders
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfOrdersResponseErrorResponse
     */
    public function getOrders($account_id, $locale)
    {
        list($response) = $this->getOrdersWithHttpInfo($account_id, $locale);
        return $response;
    }

    /**
     * Operation getOrdersWithHttpInfo
     *
     * Orders
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfOrdersResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOrdersWithHttpInfo($account_id, $locale)
    {
        $request = $this->getOrdersRequest($account_id, $locale);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfOrdersResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfOrdersResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfOrdersResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfOrdersResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrdersAsync
     *
     * Orders
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrdersAsync($account_id, $locale)
    {
        return $this->getOrdersAsyncWithHttpInfo($account_id, $locale)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrdersAsyncWithHttpInfo
     *
     * Orders
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrdersAsyncWithHttpInfo($account_id, $locale)
    {
        $returnType = 'OneOfOrdersResponseErrorResponse';
        $request = $this->getOrdersRequest($account_id, $locale);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getOrders'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getOrdersRequest($account_id, $locale)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getOrders'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getOrders'
            );
        }

        $resourcePath = '/accounts/{accountId}/orders';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getOrdersHistory
     *
     * Orders History
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $max_count Maximum count of orders to return. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfOrdersHistoryResponseErrorResponse
     */
    public function getOrdersHistory($account_id, $locale, $max_count = null)
    {
        list($response) = $this->getOrdersHistoryWithHttpInfo($account_id, $locale, $max_count);
        return $response;
    }

    /**
     * Operation getOrdersHistoryWithHttpInfo
     *
     * Orders History
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $max_count Maximum count of orders to return. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfOrdersHistoryResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOrdersHistoryWithHttpInfo($account_id, $locale, $max_count = null)
    {
        $request = $this->getOrdersHistoryRequest($account_id, $locale, $max_count);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfOrdersHistoryResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfOrdersHistoryResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfOrdersHistoryResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfOrdersHistoryResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getOrdersHistoryAsync
     *
     * Orders History
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $max_count Maximum count of orders to return. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrdersHistoryAsync($account_id, $locale, $max_count = null)
    {
        return $this->getOrdersHistoryAsyncWithHttpInfo($account_id, $locale, $max_count)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOrdersHistoryAsyncWithHttpInfo
     *
     * Orders History
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $max_count Maximum count of orders to return. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOrdersHistoryAsyncWithHttpInfo($account_id, $locale, $max_count = null)
    {
        $returnType = 'OneOfOrdersHistoryResponseErrorResponse';
        $request = $this->getOrdersHistoryRequest($account_id, $locale, $max_count);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getOrdersHistory'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $max_count Maximum count of orders to return. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getOrdersHistoryRequest($account_id, $locale, $max_count = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getOrdersHistory'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getOrdersHistory'
            );
        }

        $resourcePath = '/accounts/{accountId}/ordersHistory';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }
        // query params
        if ($max_count !== null) {
            if('form' === 'form' && is_array($max_count)) {
                foreach($max_count as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['maxCount'] = $max_count;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getPositions
     *
     * Positions
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfPositionsResponseErrorResponse
     */
    public function getPositions($account_id, $locale)
    {
        list($response) = $this->getPositionsWithHttpInfo($account_id, $locale);
        return $response;
    }

    /**
     * Operation getPositionsWithHttpInfo
     *
     * Positions
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfPositionsResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPositionsWithHttpInfo($account_id, $locale)
    {
        $request = $this->getPositionsRequest($account_id, $locale);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfPositionsResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfPositionsResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfPositionsResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfPositionsResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPositionsAsync
     *
     * Positions
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPositionsAsync($account_id, $locale)
    {
        return $this->getPositionsAsyncWithHttpInfo($account_id, $locale)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPositionsAsyncWithHttpInfo
     *
     * Positions
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPositionsAsyncWithHttpInfo($account_id, $locale)
    {
        $returnType = 'OneOfPositionsResponseErrorResponse';
        $request = $this->getPositionsRequest($account_id, $locale);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getPositions'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getPositionsRequest($account_id, $locale)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getPositions'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getPositions'
            );
        }

        $resourcePath = '/accounts/{accountId}/positions';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getState
     *
     * State
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfAccountStateResponseErrorResponse
     */
    public function getState($account_id, $locale)
    {
        list($response) = $this->getStateWithHttpInfo($account_id, $locale);
        return $response;
    }

    /**
     * Operation getStateWithHttpInfo
     *
     * State
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfAccountStateResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getStateWithHttpInfo($account_id, $locale)
    {
        $request = $this->getStateRequest($account_id, $locale);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfAccountStateResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfAccountStateResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfAccountStateResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfAccountStateResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getStateAsync
     *
     * State
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getStateAsync($account_id, $locale)
    {
        return $this->getStateAsyncWithHttpInfo($account_id, $locale)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getStateAsyncWithHttpInfo
     *
     * State
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getStateAsyncWithHttpInfo($account_id, $locale)
    {
        $returnType = 'OneOfAccountStateResponseErrorResponse';
        $request = $this->getStateRequest($account_id, $locale);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getState'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getStateRequest($account_id, $locale)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getState'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getState'
            );
        }

        $resourcePath = '/accounts/{accountId}/state';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation previewLeverage
     *
     * Preview Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by user (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfPreviewLeverageResponseErrorResponse
     */
    public function previewLeverage($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        list($response) = $this->previewLeverageWithHttpInfo($account_id, $locale, $instrument, $side, $order_type, $leverage);
        return $response;
    }

    /**
     * Operation previewLeverageWithHttpInfo
     *
     * Preview Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by user (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfPreviewLeverageResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function previewLeverageWithHttpInfo($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        $request = $this->previewLeverageRequest($account_id, $locale, $instrument, $side, $order_type, $leverage);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfPreviewLeverageResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfPreviewLeverageResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfPreviewLeverageResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfPreviewLeverageResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation previewLeverageAsync
     *
     * Preview Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by user (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function previewLeverageAsync($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        return $this->previewLeverageAsyncWithHttpInfo($account_id, $locale, $instrument, $side, $order_type, $leverage)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation previewLeverageAsyncWithHttpInfo
     *
     * Preview Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by user (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function previewLeverageAsyncWithHttpInfo($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        $returnType = 'OneOfPreviewLeverageResponseErrorResponse';
        $request = $this->previewLeverageRequest($account_id, $locale, $instrument, $side, $order_type, $leverage);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'previewLeverage'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by user (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function previewLeverageRequest($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling previewLeverage'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling previewLeverage'
            );
        }
        // verify the required parameter 'instrument' is set
        if ($instrument === null || (is_array($instrument) && count($instrument) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instrument when calling previewLeverage'
            );
        }
        // verify the required parameter 'side' is set
        if ($side === null || (is_array($side) && count($side) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $side when calling previewLeverage'
            );
        }
        // verify the required parameter 'order_type' is set
        if ($order_type === null || (is_array($order_type) && count($order_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_type when calling previewLeverage'
            );
        }
        // verify the required parameter 'leverage' is set
        if ($leverage === null || (is_array($leverage) && count($leverage) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $leverage when calling previewLeverage'
            );
        }

        $resourcePath = '/accounts/{accountId}/previewLeverage';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }

        // form params
        if ($instrument !== null) {
            $formParams['instrument'] = ObjectSerializer::toFormValue($instrument);
        }
        // form params
        if ($side !== null) {
            $formParams['side'] = ObjectSerializer::toFormValue($side);
        }
        // form params
        if ($order_type !== null) {
            $formParams['orderType'] = ObjectSerializer::toFormValue($order_type);
        }
        // form params
        if ($leverage !== null) {
            $formParams['leverage'] = ObjectSerializer::toFormValue($leverage);
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/x-www-form-urlencoded']
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation setLeverage
     *
     * Set Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by the user (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfSetLeverageResponseErrorResponse
     */
    public function setLeverage($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        list($response) = $this->setLeverageWithHttpInfo($account_id, $locale, $instrument, $side, $order_type, $leverage);
        return $response;
    }

    /**
     * Operation setLeverageWithHttpInfo
     *
     * Set Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by the user (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfSetLeverageResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function setLeverageWithHttpInfo($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        $request = $this->setLeverageRequest($account_id, $locale, $instrument, $side, $order_type, $leverage);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('OneOfSetLeverageResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfSetLeverageResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfSetLeverageResponseErrorResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'OneOfSetLeverageResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation setLeverageAsync
     *
     * Set Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by the user (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setLeverageAsync($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        return $this->setLeverageAsyncWithHttpInfo($account_id, $locale, $instrument, $side, $order_type, $leverage)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation setLeverageAsyncWithHttpInfo
     *
     * Set Leverage
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by the user (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setLeverageAsyncWithHttpInfo($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        $returnType = 'OneOfSetLeverageResponseErrorResponse';
        $request = $this->setLeverageRequest($account_id, $locale, $instrument, $side, $order_type, $leverage);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'setLeverage'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Broker instrument name. (required)
     * @param  string $side Current order side in the order ticket. (required)
     * @param  string $order_type Current order type selected in the order ticket. (required)
     * @param  float $leverage Leverage value set by the user (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function setLeverageRequest($account_id, $locale, $instrument, $side, $order_type, $leverage)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling setLeverage'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling setLeverage'
            );
        }
        // verify the required parameter 'instrument' is set
        if ($instrument === null || (is_array($instrument) && count($instrument) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instrument when calling setLeverage'
            );
        }
        // verify the required parameter 'side' is set
        if ($side === null || (is_array($side) && count($side) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $side when calling setLeverage'
            );
        }
        // verify the required parameter 'order_type' is set
        if ($order_type === null || (is_array($order_type) && count($order_type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_type when calling setLeverage'
            );
        }
        // verify the required parameter 'leverage' is set
        if ($leverage === null || (is_array($leverage) && count($leverage) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $leverage when calling setLeverage'
            );
        }

        $resourcePath = '/accounts/{accountId}/setLeverage';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($locale !== null) {
            if('form' === 'form' && is_array($locale)) {
                foreach($locale as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['locale'] = $locale;
            }
        }


        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                '{' . 'accountId' . '}',
                ObjectSerializer::toPathValue($account_id),
                $resourcePath
            );
        }

        // form params
        if ($instrument !== null) {
            $formParams['instrument'] = ObjectSerializer::toFormValue($instrument);
        }
        // form params
        if ($side !== null) {
            $formParams['side'] = ObjectSerializer::toFormValue($side);
        }
        // form params
        if ($order_type !== null) {
            $formParams['orderType'] = ObjectSerializer::toFormValue($order_type);
        }
        // form params
        if ($leverage !== null) {
            $formParams['leverage'] = ObjectSerializer::toFormValue($leverage);
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/x-www-form-urlencoded']
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires Bearer (Bearer ACCESS_TOKEN) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
