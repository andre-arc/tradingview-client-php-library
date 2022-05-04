# OpenAPI\Client\DataIntegrationApi

All URIs are relative to https://your-rest-implementation.com/api.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getHistory()**](DataIntegrationApi.md#getHistory) | **GET** /history | History
[**getSymbolInfo()**](DataIntegrationApi.md#getSymbolInfo) | **GET** /symbol_info | Symbol Info
[**streaming()**](DataIntegrationApi.md#streaming) | **GET** /streaming | Stream of prices


## `getHistory()`

```php
getHistory($symbol, $resolution, $from, $to, $countback): OneOfHistorySuccessResponseHistoryNoDataResponseHistoryEmptyBarResponseErrorResponse
```

History

Request for history bars. Each property of the response object is treated as a table column.  Data should meet the following requirements:  - real-time data obtained from the API streaming endpoint must match the historical data, obtained from the   /history API. The allowed count of mismatched bars (candles) must not exceed 5% for frequently traded symbols,   otherwise the integration to TradingView is not possible; - the data must not include unreasonable price gaps, historical data gaps on 1-minute and Daily-resolutions   (temporal gaps), obviously incorrect prices (adhesions).  Bar time for daily bars should be 00:00 UTC and is expected to be a trading day (not a day when the session starts).  Bar time for monthly bars should be 00:00 UTC and is the first trading day of the month.  If there is no data in the requested time period but there is data in the previous time period you should return an empty response: `{\"s\":\"ok\",\"t\":[],\"o\":[],\"h\":[],\"l\":[],\"c\":[],\"v\":[]}`  If there is no data in the requested and previous time periods then you should set the status code to `no_data`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (Bearer ACCESS_TOKEN) authorization: PasswordBearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: ServerOAuth2Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DataIntegrationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$symbol = 'symbol_example'; // string | Symbol name or ticker.
$resolution = 'resolution_example'; // string | Symbol resolution. Possible resolutions are daily (`D` or `1D`, `2D` ... ), weekly (`1W`, `2W` ...), monthly (`1M`, `2M`...) and an intra-day resolution &ndash; minutes(`1`, `2` ...).
$from = 3.4; // float | Unix timestamp (UTC) of the leftmost required bar, including `from`.
$to = 3.4; // float | Unix timestamp (UTC) of the rightmost required bar, including `to`. It can be in the future. In this case, the rightmost required bar is the latest available bar.
$countback = 3.4; // float | Number of bars (higher priority than `from`) starting with `to`. If `countback` is set, `from` should be ignored.

try {
    $result = $apiInstance->getHistory($symbol, $resolution, $from, $to, $countback);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataIntegrationApi->getHistory: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **symbol** | **string**| Symbol name or ticker. |
 **resolution** | **string**| Symbol resolution. Possible resolutions are daily (&#x60;D&#x60; or &#x60;1D&#x60;, &#x60;2D&#x60; ... ), weekly (&#x60;1W&#x60;, &#x60;2W&#x60; ...), monthly (&#x60;1M&#x60;, &#x60;2M&#x60;...) and an intra-day resolution &amp;ndash; minutes(&#x60;1&#x60;, &#x60;2&#x60; ...). |
 **from** | **float**| Unix timestamp (UTC) of the leftmost required bar, including &#x60;from&#x60;. |
 **to** | **float**| Unix timestamp (UTC) of the rightmost required bar, including &#x60;to&#x60;. It can be in the future. In this case, the rightmost required bar is the latest available bar. |
 **countback** | **float**| Number of bars (higher priority than &#x60;from&#x60;) starting with &#x60;to&#x60;. If &#x60;countback&#x60; is set, &#x60;from&#x60; should be ignored. | [optional]

### Return type

[**OneOfHistorySuccessResponseHistoryNoDataResponseHistoryEmptyBarResponseErrorResponse**](../Model/OneOfHistorySuccessResponseHistoryNoDataResponseHistoryEmptyBarResponseErrorResponse.md)

### Authorization

[PasswordBearer](../../README.md#PasswordBearer), [ServerOAuth2Bearer](../../README.md#ServerOAuth2Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSymbolInfo()`

```php
getSymbolInfo($group): OneOfSymbolInfoResponseErrorResponse
```

Symbol Info

Get a list of all instruments.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (Bearer ACCESS_TOKEN) authorization: PasswordBearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: ServerOAuth2Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DataIntegrationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$group = 'group_example'; // string | ID of a symbol group. If it presents then only symbols that belong to this group should be returned. Possible values are provided by the [/groups](#operation/getGroups) endpoint. It is only required if you use groups of symbols to restrict access to instrument's data.

try {
    $result = $apiInstance->getSymbolInfo($group);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataIntegrationApi->getSymbolInfo: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **group** | **string**| ID of a symbol group. If it presents then only symbols that belong to this group should be returned. Possible values are provided by the [/groups](#operation/getGroups) endpoint. It is only required if you use groups of symbols to restrict access to instrument&#39;s data. | [optional]

### Return type

[**OneOfSymbolInfoResponseErrorResponse**](../Model/OneOfSymbolInfoResponseErrorResponse.md)

### Authorization

[PasswordBearer](../../README.md#PasswordBearer), [ServerOAuth2Bearer](../../README.md#ServerOAuth2Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `streaming()`

```php
streaming(): OneOfStreamingQuoteResponseStreamingTradeResponseStreamingDailyBarResponseStreamingAskResponseDeprecatedStreamingBidResponseDeprecated
```

Stream of prices

Stream of prices. Server constantly keeps the connection alive. If the connection is broken - the server constantly tries to restore it. TradingView establishes up to 4 simultaneous connections to this endpoint and expects to get the same data to all of them. Transfer mode is `chunked encoding`. The data feed should set `'Transfer-Encoding: chunked'` and make sure that all intermediate proxies are set to use this mode. All messages are to be ended with `\\n`. Data stream should contain real-time data only. It shouldn't contain snapshots of data.  Data feed should provide trades and quotes: - If trades are not provided, then data feed should set trades with bid price and bid size (mid price with 0 size in case of Forex). - Size is always greater than `0`, except for the correction. In that case size can be `0`. - Quote must contain prices of the best ask and the best bid. - Daily bars are required if they cannot be built from trades (has-daily should be set to true in the symbol information in that case).  The broker must remove unnecessary restrictions (firewall, rate limits, etc.) for the set of IP addresses of our servers.  Please note, that `StreamingAskResponse` and `StreamingBidResponse` are deprecated. The `StreamingQuoteResponse` should be used to provide ask / bid data.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (Bearer ACCESS_TOKEN) authorization: PasswordBearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: ServerOAuth2Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DataIntegrationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->streaming();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataIntegrationApi->streaming: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**OneOfStreamingQuoteResponseStreamingTradeResponseStreamingDailyBarResponseStreamingAskResponseDeprecatedStreamingBidResponseDeprecated**](../Model/OneOfStreamingQuoteResponseStreamingTradeResponseStreamingDailyBarResponseStreamingAskResponseDeprecatedStreamingBidResponseDeprecated.md)

### Authorization

[PasswordBearer](../../README.md#PasswordBearer), [ServerOAuth2Bearer](../../README.md#ServerOAuth2Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
