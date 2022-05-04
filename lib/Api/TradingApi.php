<?php
/**
 * TradingApi
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
 * TradingApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class TradingApi
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
     * Operation cancelOrder
     *
     * Cancel Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfSuccessResponseErrorResponse
     */
    public function cancelOrder($account_id, $order_id, $locale)
    {
        list($response) = $this->cancelOrderWithHttpInfo($account_id, $order_id, $locale);
        return $response;
    }

    /**
     * Operation cancelOrderWithHttpInfo
     *
     * Cancel Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfSuccessResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function cancelOrderWithHttpInfo($account_id, $order_id, $locale)
    {
        $request = $this->cancelOrderRequest($account_id, $order_id, $locale);

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
                    if ('OneOfSuccessResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfSuccessResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfSuccessResponseErrorResponse';
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
                        'OneOfSuccessResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation cancelOrderAsync
     *
     * Cancel Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelOrderAsync($account_id, $order_id, $locale)
    {
        return $this->cancelOrderAsyncWithHttpInfo($account_id, $order_id, $locale)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelOrderAsyncWithHttpInfo
     *
     * Cancel Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelOrderAsyncWithHttpInfo($account_id, $order_id, $locale)
    {
        $returnType = 'OneOfSuccessResponseErrorResponse';
        $request = $this->cancelOrderRequest($account_id, $order_id, $locale);

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
     * Create request for operation 'cancelOrder'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function cancelOrderRequest($account_id, $order_id, $locale)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling cancelOrder'
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling cancelOrder'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling cancelOrder'
            );
        }

        $resourcePath = '/accounts/{accountId}/orders/{orderId}';
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
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
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
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation closePosition
     *
     * Close Position
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $amount Amount to close. This property is used if supportPartialClosePosition flag is &#x60;true&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfSuccessResponseErrorResponse
     */
    public function closePosition($account_id, $position_id, $locale, $amount = null)
    {
        list($response) = $this->closePositionWithHttpInfo($account_id, $position_id, $locale, $amount);
        return $response;
    }

    /**
     * Operation closePositionWithHttpInfo
     *
     * Close Position
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $amount Amount to close. This property is used if supportPartialClosePosition flag is &#x60;true&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfSuccessResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function closePositionWithHttpInfo($account_id, $position_id, $locale, $amount = null)
    {
        $request = $this->closePositionRequest($account_id, $position_id, $locale, $amount);

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
                    if ('OneOfSuccessResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfSuccessResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfSuccessResponseErrorResponse';
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
                        'OneOfSuccessResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation closePositionAsync
     *
     * Close Position
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $amount Amount to close. This property is used if supportPartialClosePosition flag is &#x60;true&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function closePositionAsync($account_id, $position_id, $locale, $amount = null)
    {
        return $this->closePositionAsyncWithHttpInfo($account_id, $position_id, $locale, $amount)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation closePositionAsyncWithHttpInfo
     *
     * Close Position
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $amount Amount to close. This property is used if supportPartialClosePosition flag is &#x60;true&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function closePositionAsyncWithHttpInfo($account_id, $position_id, $locale, $amount = null)
    {
        $returnType = 'OneOfSuccessResponseErrorResponse';
        $request = $this->closePositionRequest($account_id, $position_id, $locale, $amount);

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
     * Create request for operation 'closePosition'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $amount Amount to close. This property is used if supportPartialClosePosition flag is &#x60;true&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function closePositionRequest($account_id, $position_id, $locale, $amount = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling closePosition'
            );
        }
        // verify the required parameter 'position_id' is set
        if ($position_id === null || (is_array($position_id) && count($position_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $position_id when calling closePosition'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling closePosition'
            );
        }

        $resourcePath = '/accounts/{accountId}/positions/{positionId}';
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
        // path params
        if ($position_id !== null) {
            $resourcePath = str_replace(
                '{' . 'positionId' . '}',
                ObjectSerializer::toPathValue($position_id),
                $resourcePath
            );
        }

        // form params
        if ($amount !== null) {
            $formParams['amount'] = ObjectSerializer::toFormValue($amount);
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
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation modifyOrder
     *
     * Modify Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfSuccessResponseErrorResponse
     */
    public function modifyOrder($account_id, $order_id, $locale, $qty, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null)
    {
        list($response) = $this->modifyOrderWithHttpInfo($account_id, $order_id, $locale, $qty, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid);
        return $response;
    }

    /**
     * Operation modifyOrderWithHttpInfo
     *
     * Modify Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfSuccessResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function modifyOrderWithHttpInfo($account_id, $order_id, $locale, $qty, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null)
    {
        $request = $this->modifyOrderRequest($account_id, $order_id, $locale, $qty, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid);

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
                    if ('OneOfSuccessResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfSuccessResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfSuccessResponseErrorResponse';
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
                        'OneOfSuccessResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation modifyOrderAsync
     *
     * Modify Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyOrderAsync($account_id, $order_id, $locale, $qty, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null)
    {
        return $this->modifyOrderAsyncWithHttpInfo($account_id, $order_id, $locale, $qty, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyOrderAsyncWithHttpInfo
     *
     * Modify Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyOrderAsyncWithHttpInfo($account_id, $order_id, $locale, $qty, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null)
    {
        $returnType = 'OneOfSuccessResponseErrorResponse';
        $request = $this->modifyOrderRequest($account_id, $order_id, $locale, $qty, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid);

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
     * Create request for operation 'modifyOrder'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $order_id Order identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function modifyOrderRequest($account_id, $order_id, $locale, $qty, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling modifyOrder'
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling modifyOrder'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling modifyOrder'
            );
        }
        // verify the required parameter 'qty' is set
        if ($qty === null || (is_array($qty) && count($qty) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $qty when calling modifyOrder'
            );
        }

        $resourcePath = '/accounts/{accountId}/orders/{orderId}';
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
        if ($confirm_id !== null) {
            if('form' === 'form' && is_array($confirm_id)) {
                foreach($confirm_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['confirmId'] = $confirm_id;
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
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'orderId' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }

        // form params
        if ($qty !== null) {
            $formParams['qty'] = ObjectSerializer::toFormValue($qty);
        }
        // form params
        if ($limit_price !== null) {
            $formParams['limitPrice'] = ObjectSerializer::toFormValue($limit_price);
        }
        // form params
        if ($stop_price !== null) {
            $formParams['stopPrice'] = ObjectSerializer::toFormValue($stop_price);
        }
        // form params
        if ($duration_type !== null) {
            $formParams['durationType'] = ObjectSerializer::toFormValue($duration_type);
        }
        // form params
        if ($duration_date_time !== null) {
            $formParams['durationDateTime'] = ObjectSerializer::toFormValue($duration_date_time);
        }
        // form params
        if ($stop_loss !== null) {
            $formParams['stopLoss'] = ObjectSerializer::toFormValue($stop_loss);
        }
        // form params
        if ($trailing_stop_pips !== null) {
            $formParams['trailingStopPips'] = ObjectSerializer::toFormValue($trailing_stop_pips);
        }
        // form params
        if ($take_profit !== null) {
            $formParams['takeProfit'] = ObjectSerializer::toFormValue($take_profit);
        }
        // form params
        if ($digital_signature !== null) {
            $formParams['digitalSignature'] = ObjectSerializer::toFormValue($digital_signature);
        }
        // form params
        if ($current_ask !== null) {
            $formParams['currentAsk'] = ObjectSerializer::toFormValue($current_ask);
        }
        // form params
        if ($current_bid !== null) {
            $formParams['currentBid'] = ObjectSerializer::toFormValue($current_bid);
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
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation modifyPosition
     *
     * Modify Position
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $side New side of the position. This parameter is used to reverse the position, if the &#x60;supportNativeReversePosition&#x60; flag is enabled in the account config. Please see the [/accounts](#operation/getAccounts) endpoint. (optional)
     * @param  float $stop_loss StopLoss price. (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the order price in pips. (optional)
     * @param  float $take_profit TakeProfit price. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfSuccessResponseErrorResponse
     */
    public function modifyPosition($account_id, $position_id, $locale, $side = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null)
    {
        list($response) = $this->modifyPositionWithHttpInfo($account_id, $position_id, $locale, $side, $stop_loss, $trailing_stop_pips, $take_profit);
        return $response;
    }

    /**
     * Operation modifyPositionWithHttpInfo
     *
     * Modify Position
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $side New side of the position. This parameter is used to reverse the position, if the &#x60;supportNativeReversePosition&#x60; flag is enabled in the account config. Please see the [/accounts](#operation/getAccounts) endpoint. (optional)
     * @param  float $stop_loss StopLoss price. (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the order price in pips. (optional)
     * @param  float $take_profit TakeProfit price. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfSuccessResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function modifyPositionWithHttpInfo($account_id, $position_id, $locale, $side = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null)
    {
        $request = $this->modifyPositionRequest($account_id, $position_id, $locale, $side, $stop_loss, $trailing_stop_pips, $take_profit);

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
                    if ('OneOfSuccessResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfSuccessResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfSuccessResponseErrorResponse';
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
                        'OneOfSuccessResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation modifyPositionAsync
     *
     * Modify Position
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $side New side of the position. This parameter is used to reverse the position, if the &#x60;supportNativeReversePosition&#x60; flag is enabled in the account config. Please see the [/accounts](#operation/getAccounts) endpoint. (optional)
     * @param  float $stop_loss StopLoss price. (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the order price in pips. (optional)
     * @param  float $take_profit TakeProfit price. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyPositionAsync($account_id, $position_id, $locale, $side = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null)
    {
        return $this->modifyPositionAsyncWithHttpInfo($account_id, $position_id, $locale, $side, $stop_loss, $trailing_stop_pips, $take_profit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyPositionAsyncWithHttpInfo
     *
     * Modify Position
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $side New side of the position. This parameter is used to reverse the position, if the &#x60;supportNativeReversePosition&#x60; flag is enabled in the account config. Please see the [/accounts](#operation/getAccounts) endpoint. (optional)
     * @param  float $stop_loss StopLoss price. (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the order price in pips. (optional)
     * @param  float $take_profit TakeProfit price. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyPositionAsyncWithHttpInfo($account_id, $position_id, $locale, $side = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null)
    {
        $returnType = 'OneOfSuccessResponseErrorResponse';
        $request = $this->modifyPositionRequest($account_id, $position_id, $locale, $side, $stop_loss, $trailing_stop_pips, $take_profit);

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
     * Create request for operation 'modifyPosition'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  string $position_id Position identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $side New side of the position. This parameter is used to reverse the position, if the &#x60;supportNativeReversePosition&#x60; flag is enabled in the account config. Please see the [/accounts](#operation/getAccounts) endpoint. (optional)
     * @param  float $stop_loss StopLoss price. (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the order price in pips. (optional)
     * @param  float $take_profit TakeProfit price. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function modifyPositionRequest($account_id, $position_id, $locale, $side = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling modifyPosition'
            );
        }
        // verify the required parameter 'position_id' is set
        if ($position_id === null || (is_array($position_id) && count($position_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $position_id when calling modifyPosition'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling modifyPosition'
            );
        }

        $resourcePath = '/accounts/{accountId}/positions/{positionId}';
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
        // path params
        if ($position_id !== null) {
            $resourcePath = str_replace(
                '{' . 'positionId' . '}',
                ObjectSerializer::toPathValue($position_id),
                $resourcePath
            );
        }

        // form params
        if ($side !== null) {
            $formParams['side'] = ObjectSerializer::toFormValue($side);
        }
        // form params
        if ($stop_loss !== null) {
            $formParams['stopLoss'] = ObjectSerializer::toFormValue($stop_loss);
        }
        // form params
        if ($trailing_stop_pips !== null) {
            $formParams['trailingStopPips'] = ObjectSerializer::toFormValue($trailing_stop_pips);
        }
        // form params
        if ($take_profit !== null) {
            $formParams['takeProfit'] = ObjectSerializer::toFormValue($take_profit);
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
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation placeOrder
     *
     * Place Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $qty The number of units. (required)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (required)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (required)
     * @param  string $request_id Unique identifier for a request. (optional)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfPostOrderResponseErrorResponse
     */
    public function placeOrder($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id = null, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null)
    {
        list($response) = $this->placeOrderWithHttpInfo($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature);
        return $response;
    }

    /**
     * Operation placeOrderWithHttpInfo
     *
     * Place Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $qty The number of units. (required)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (required)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (required)
     * @param  string $request_id Unique identifier for a request. (optional)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfPostOrderResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function placeOrderWithHttpInfo($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id = null, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null)
    {
        $request = $this->placeOrderRequest($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature);

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
                    if ('OneOfPostOrderResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfPostOrderResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfPostOrderResponseErrorResponse';
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
                        'OneOfPostOrderResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation placeOrderAsync
     *
     * Place Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $qty The number of units. (required)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (required)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (required)
     * @param  string $request_id Unique identifier for a request. (optional)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function placeOrderAsync($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id = null, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null)
    {
        return $this->placeOrderAsyncWithHttpInfo($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation placeOrderAsyncWithHttpInfo
     *
     * Place Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $qty The number of units. (required)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (required)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (required)
     * @param  string $request_id Unique identifier for a request. (optional)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function placeOrderAsyncWithHttpInfo($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id = null, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null)
    {
        $returnType = 'OneOfPostOrderResponseErrorResponse';
        $request = $this->placeOrderRequest($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature);

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
     * Create request for operation 'placeOrder'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $qty The number of units. (required)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (required)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (required)
     * @param  string $request_id Unique identifier for a request. (optional)
     * @param  string $confirm_id Identifier of an order received in the preview order request. (optional)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function placeOrderRequest($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id = null, $confirm_id = null, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling placeOrder'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling placeOrder'
            );
        }
        // verify the required parameter 'instrument' is set
        if ($instrument === null || (is_array($instrument) && count($instrument) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instrument when calling placeOrder'
            );
        }
        // verify the required parameter 'side' is set
        if ($side === null || (is_array($side) && count($side) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $side when calling placeOrder'
            );
        }
        // verify the required parameter 'type' is set
        if ($type === null || (is_array($type) && count($type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $type when calling placeOrder'
            );
        }
        // verify the required parameter 'qty' is set
        if ($qty === null || (is_array($qty) && count($qty) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $qty when calling placeOrder'
            );
        }
        // verify the required parameter 'current_ask' is set
        if ($current_ask === null || (is_array($current_ask) && count($current_ask) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $current_ask when calling placeOrder'
            );
        }
        // verify the required parameter 'current_bid' is set
        if ($current_bid === null || (is_array($current_bid) && count($current_bid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $current_bid when calling placeOrder'
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
        // query params
        if ($request_id !== null) {
            if('form' === 'form' && is_array($request_id)) {
                foreach($request_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['requestId'] = $request_id;
            }
        }
        // query params
        if ($confirm_id !== null) {
            if('form' === 'form' && is_array($confirm_id)) {
                foreach($confirm_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['confirmId'] = $confirm_id;
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
        if ($type !== null) {
            $formParams['type'] = ObjectSerializer::toFormValue($type);
        }
        // form params
        if ($qty !== null) {
            $formParams['qty'] = ObjectSerializer::toFormValue($qty);
        }
        // form params
        if ($limit_price !== null) {
            $formParams['limitPrice'] = ObjectSerializer::toFormValue($limit_price);
        }
        // form params
        if ($stop_price !== null) {
            $formParams['stopPrice'] = ObjectSerializer::toFormValue($stop_price);
        }
        // form params
        if ($duration_type !== null) {
            $formParams['durationType'] = ObjectSerializer::toFormValue($duration_type);
        }
        // form params
        if ($duration_date_time !== null) {
            $formParams['durationDateTime'] = ObjectSerializer::toFormValue($duration_date_time);
        }
        // form params
        if ($stop_loss !== null) {
            $formParams['stopLoss'] = ObjectSerializer::toFormValue($stop_loss);
        }
        // form params
        if ($trailing_stop_pips !== null) {
            $formParams['trailingStopPips'] = ObjectSerializer::toFormValue($trailing_stop_pips);
        }
        // form params
        if ($take_profit !== null) {
            $formParams['takeProfit'] = ObjectSerializer::toFormValue($take_profit);
        }
        // form params
        if ($digital_signature !== null) {
            $formParams['digitalSignature'] = ObjectSerializer::toFormValue($digital_signature);
        }
        // form params
        if ($current_ask !== null) {
            $formParams['currentAsk'] = ObjectSerializer::toFormValue($current_ask);
        }
        // form params
        if ($current_bid !== null) {
            $formParams['currentBid'] = ObjectSerializer::toFormValue($current_bid);
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
     * Operation previewOrder
     *
     * Preview Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     * @param  string $id Identifier of the order that is being modified by the user. This parameter is sent only if &#x60;supportModifyOrderPreview&#x60; flag is &#x60;true&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return OneOfPreviewOrderResponseErrorResponse
     */
    public function previewOrder($account_id, $locale, $qty, $instrument, $side, $type, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null, $id = null)
    {
        list($response) = $this->previewOrderWithHttpInfo($account_id, $locale, $qty, $instrument, $side, $type, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid, $id);
        return $response;
    }

    /**
     * Operation previewOrderWithHttpInfo
     *
     * Preview Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     * @param  string $id Identifier of the order that is being modified by the user. This parameter is sent only if &#x60;supportModifyOrderPreview&#x60; flag is &#x60;true&#x60;. (optional)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of OneOfPreviewOrderResponseErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function previewOrderWithHttpInfo($account_id, $locale, $qty, $instrument, $side, $type, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null, $id = null)
    {
        $request = $this->previewOrderRequest($account_id, $locale, $qty, $instrument, $side, $type, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid, $id);

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
                    if ('OneOfPreviewOrderResponseErrorResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'OneOfPreviewOrderResponseErrorResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'OneOfPreviewOrderResponseErrorResponse';
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
                        'OneOfPreviewOrderResponseErrorResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation previewOrderAsync
     *
     * Preview Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     * @param  string $id Identifier of the order that is being modified by the user. This parameter is sent only if &#x60;supportModifyOrderPreview&#x60; flag is &#x60;true&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function previewOrderAsync($account_id, $locale, $qty, $instrument, $side, $type, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null, $id = null)
    {
        return $this->previewOrderAsyncWithHttpInfo($account_id, $locale, $qty, $instrument, $side, $type, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation previewOrderAsyncWithHttpInfo
     *
     * Preview Order
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     * @param  string $id Identifier of the order that is being modified by the user. This parameter is sent only if &#x60;supportModifyOrderPreview&#x60; flag is &#x60;true&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function previewOrderAsyncWithHttpInfo($account_id, $locale, $qty, $instrument, $side, $type, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null, $id = null)
    {
        $returnType = 'OneOfPreviewOrderResponseErrorResponse';
        $request = $this->previewOrderRequest($account_id, $locale, $qty, $instrument, $side, $type, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid, $id);

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
     * Create request for operation 'previewOrder'
     *
     * @param  string $account_id Account identifier. (required)
     * @param  \OpenAPI\Client\Model\Locale $locale Locale (language) id. (required)
     * @param  float $qty The number of units. (required)
     * @param  string $instrument Instrument. (required)
     * @param  string $side Side. (required)
     * @param  string $type Type. (required)
     * @param  float $limit_price Limit Price for Limit or StopLimit order. (optional)
     * @param  float $stop_price Stop Price for Stop or StopLimit order. (optional)
     * @param  string $duration_type Duration ID (if supported). (optional)
     * @param  float $duration_date_time Expiration datetime Unix timestamp (if supported by duration type). (optional)
     * @param  float $stop_loss StopLoss price (if supported). (optional)
     * @param  float $trailing_stop_pips Distance from the stop loss level to the current market price in pips (if supported by the broker). (optional)
     * @param  float $take_profit TakeProfit price (if supported). (optional)
     * @param  string $digital_signature Digital signature (if supported). (optional)
     * @param  float $current_ask Current ask price for the instrument that the user sees in the order panel. (optional)
     * @param  float $current_bid Current bid price for the instrument that the user sees in the order panel. (optional)
     * @param  string $id Identifier of the order that is being modified by the user. This parameter is sent only if &#x60;supportModifyOrderPreview&#x60; flag is &#x60;true&#x60;. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function previewOrderRequest($account_id, $locale, $qty, $instrument, $side, $type, $limit_price = null, $stop_price = null, $duration_type = null, $duration_date_time = null, $stop_loss = null, $trailing_stop_pips = null, $take_profit = null, $digital_signature = null, $current_ask = null, $current_bid = null, $id = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null || (is_array($account_id) && count($account_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $account_id when calling previewOrder'
            );
        }
        // verify the required parameter 'locale' is set
        if ($locale === null || (is_array($locale) && count($locale) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $locale when calling previewOrder'
            );
        }
        // verify the required parameter 'qty' is set
        if ($qty === null || (is_array($qty) && count($qty) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $qty when calling previewOrder'
            );
        }
        // verify the required parameter 'instrument' is set
        if ($instrument === null || (is_array($instrument) && count($instrument) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $instrument when calling previewOrder'
            );
        }
        // verify the required parameter 'side' is set
        if ($side === null || (is_array($side) && count($side) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $side when calling previewOrder'
            );
        }
        // verify the required parameter 'type' is set
        if ($type === null || (is_array($type) && count($type) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $type when calling previewOrder'
            );
        }

        $resourcePath = '/accounts/{accountId}/previewOrder';
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
        if ($qty !== null) {
            $formParams['qty'] = ObjectSerializer::toFormValue($qty);
        }
        // form params
        if ($limit_price !== null) {
            $formParams['limitPrice'] = ObjectSerializer::toFormValue($limit_price);
        }
        // form params
        if ($stop_price !== null) {
            $formParams['stopPrice'] = ObjectSerializer::toFormValue($stop_price);
        }
        // form params
        if ($duration_type !== null) {
            $formParams['durationType'] = ObjectSerializer::toFormValue($duration_type);
        }
        // form params
        if ($duration_date_time !== null) {
            $formParams['durationDateTime'] = ObjectSerializer::toFormValue($duration_date_time);
        }
        // form params
        if ($stop_loss !== null) {
            $formParams['stopLoss'] = ObjectSerializer::toFormValue($stop_loss);
        }
        // form params
        if ($trailing_stop_pips !== null) {
            $formParams['trailingStopPips'] = ObjectSerializer::toFormValue($trailing_stop_pips);
        }
        // form params
        if ($take_profit !== null) {
            $formParams['takeProfit'] = ObjectSerializer::toFormValue($take_profit);
        }
        // form params
        if ($digital_signature !== null) {
            $formParams['digitalSignature'] = ObjectSerializer::toFormValue($digital_signature);
        }
        // form params
        if ($current_ask !== null) {
            $formParams['currentAsk'] = ObjectSerializer::toFormValue($current_ask);
        }
        // form params
        if ($current_bid !== null) {
            $formParams['currentBid'] = ObjectSerializer::toFormValue($current_bid);
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
        if ($type !== null) {
            $formParams['type'] = ObjectSerializer::toFormValue($type);
        }
        // form params
        if ($id !== null) {
            $formParams['id'] = ObjectSerializer::toFormValue($id);
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
