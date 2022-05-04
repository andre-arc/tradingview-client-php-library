# OpenAPI\Client\BrokerConfigurationApi

All URIs are relative to https://your-rest-implementation.com/api.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getConfiguration()**](BrokerConfigurationApi.md#getConfiguration) | **GET** /config | Configuration
[**getMapping()**](BrokerConfigurationApi.md#getMapping) | **GET** /mapping | Mapping


## `getConfiguration()`

```php
getConfiguration($locale): OneOfConfigResponseErrorResponse
```

Configuration

Get localized configuration.

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


$apiInstance = new OpenAPI\Client\Api\BrokerConfigurationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.

try {
    $result = $apiInstance->getConfiguration($locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrokerConfigurationApi->getConfiguration: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |

### Return type

[**OneOfConfigResponseErrorResponse**](../Model/OneOfConfigResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getMapping()`

```php
getMapping(): \OpenAPI\Client\Model\SymbolMapping
```

Mapping

Return all broker instruments with corresponding TradingView instruments. It is required to add a Broker to TradingView.com. Please note that this endpoint works without authorization!

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\BrokerConfigurationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getMapping();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BrokerConfigurationApi->getMapping: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\SymbolMapping**](../Model/SymbolMapping.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
