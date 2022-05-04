<?php
/**
 * MarketDataApi
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
 * MarketDataApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class MarketDataApi
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
     * Operation getDepth
     *
     * Depth
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbol Instrument name. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfDepthResponseErrorResponse
     */
    public function getDepth($locale, $account_id, $symbol)
    {
        list($response) = $this->getDepthWithHttpInfo($locale, $account_id, $symbol);
        return $response;
    }

    /**
     * Operation getDepthWithHttpInfo
     *
     * Depth
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbol Instrument name. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfDepthResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDepthWithHttpInfo($locale, $account_id, $symbol)
    {
        $request = $this->getDepthRequest($locale, $account_id, $symbol);

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
                    if ('OneOfDepthResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfDepthResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfDepthResponseErrorResponse';
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
                        'OneOfDepthResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getDepthAsync
     *
     * Depth
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbol Instrument name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDepthAsync($locale, $account_id, $symbol)
    {
        return $this->getDepthAsyncWithHttpInfo($locale, $account_id, $symbol)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDepthAsyncWithHttpInfo
     *
     * Depth
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbol Instrument name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDepthAsyncWithHttpInfo($locale, $account_id, $symbol)
    {
        $returnType = 'OneOfDepthResponseErrorResponse';
        $request = $this->getDepthRequest($locale, $account_id, $symbol);

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
     * Create request for operation 'getDepth'
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbol Instrument name. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getDepthRequest($locale, $account_id, $symbol)
    {
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getDepth'
            );
        }
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getDepth'
            );
        }
        // verify the required parameter 'symbol' is set
        if ($symbol === null || (is_array($symbol) && count($symbol) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $symbol when calling getDepth'
            );
        }

        $resourcePath = '/depth';
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
        if ($account_id !== null) {
            if('form' === 'form' && is_array($account_id)) {
                foreach($account_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['accountId'] = $account_id;
            }
        }
        // query params
        if ($symbol !== null) {
            if('form' === 'form' && is_array($symbol)) {
                foreach($symbol as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['symbol'] = $symbol;
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
     * Operation getQuotes
     *
     * Quotes
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbols Comma separated symbol list. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfQuotesResponseErrorResponse
     */
    public function getQuotes($locale, $account_id, $symbols)
    {
        list($response) = $this->getQuotesWithHttpInfo($locale, $account_id, $symbols);
        return $response;
    }

    /**
     * Operation getQuotesWithHttpInfo
     *
     * Quotes
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbols Comma separated symbol list. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfQuotesResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getQuotesWithHttpInfo($locale, $account_id, $symbols)
    {
        $request = $this->getQuotesRequest($locale, $account_id, $symbols);

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
                    if ('OneOfQuotesResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfQuotesResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfQuotesResponseErrorResponse';
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
                        'OneOfQuotesResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getQuotesAsync
     *
     * Quotes
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbols Comma separated symbol list. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getQuotesAsync($locale, $account_id, $symbols)
    {
        return $this->getQuotesAsyncWithHttpInfo($locale, $account_id, $symbols)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getQuotesAsyncWithHttpInfo
     *
     * Quotes
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbols Comma separated symbol list. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getQuotesAsyncWithHttpInfo($locale, $account_id, $symbols)
    {
        $returnType = 'OneOfQuotesResponseErrorResponse';
        $request = $this->getQuotesRequest($locale, $account_id, $symbols);

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
     * Create request for operation 'getQuotes'
     *
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $account_id Account identifier. (required)
     * @param  string $symbols Comma separated symbol list. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getQuotesRequest($locale, $account_id, $symbols)
    {
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling getQuotes'
            );
        }
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling getQuotes'
            );
        }
        // verify the required parameter 'symbols' is set
        if ($symbols === null || (is_array($symbols) && count($symbols) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $symbols when calling getQuotes'
            );
        }

        $resourcePath = '/quotes';
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
        if ($account_id !== null) {
            if('form' === 'form' && is_array($account_id)) {
                foreach($account_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['accountId'] = $account_id;
            }
        }
        // query params
        if ($symbols !== null) {
            if('form' === 'form' && is_array($symbols)) {
                foreach($symbols as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['symbols'] = $symbols;
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
