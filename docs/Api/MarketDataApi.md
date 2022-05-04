# OpenAPI\Client\MarketDataApi

All URIs are relative to https://your-rest-implementation.com/api.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getDepth()**](MarketDataApi.md#getDepth) | **GET** /depth | Depth
[**getQuotes()**](MarketDataApi.md#getQuotes) | **GET** /quotes | Quotes


## `getDepth()`

```php
getDepth($locale, $account_id, $symbol): OneOfDepthResponseErrorResponse
```

Depth

Get current depth of market for the instrument. Optional.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: OAuth2Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer (Bearer ACCESS_TOKEN) authorization: PasswordBearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MarketDataApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$account_id = 'account_id_example'; // string | Account identifier.
$symbol = 'symbol_example'; // string | Instrument name.

try {
    $result = $apiInstance->getDepth($locale, $account_id, $symbol);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MarketDataApi->getDepth: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **account_id** | **string**| Account identifier. |
 **symbol** | **string**| Instrument name. |

### Return type

[**OneOfDepthResponseErrorResponse**](../Model/OneOfDepthResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getQuotes()`

```php
getQuotes($locale, $account_id, $symbols): OneOfQuotesResponseErrorResponse
```

Quotes

Get current prices of the instrument. The `bid` and `ask` fields are required, and the `buyPipValue` and `sellPipValue` fields are desirable if the account currency is different from the currency of the instrument. The same values should be sent for these fields if different values for buying and selling are not supported.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: OAuth2Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: OAuth2Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure Bearer (Bearer ACCESS_TOKEN) authorization: PasswordBearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\MarketDataApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$account_id = 'account_id_example'; // string | Account identifier.
$symbols = 'symbols_example'; // string | Comma separated symbol list.

try {
    $result = $apiInstance->getQuotes($locale, $account_id, $symbols);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MarketDataApi->getQuotes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **account_id** | **string**| Account identifier. |
 **symbols** | **string**| Comma separated symbol list. |

### Return type

[**OneOfQuotesResponseErrorResponse**](../Model/OneOfQuotesResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
