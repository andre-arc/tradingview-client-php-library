# OpenAPI\Client\AccountApi

All URIs are relative to https://your-rest-implementation.com/api.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getAccounts()**](AccountApi.md#getAccounts) | **GET** /accounts | Accounts
[**getBalances()**](AccountApi.md#getBalances) | **GET** /accounts/{accountId}/balances | Balances
[**getExecutions()**](AccountApi.md#getExecutions) | **GET** /accounts/{accountId}/executions | Executions
[**getInstruments()**](AccountApi.md#getInstruments) | **GET** /accounts/{accountId}/instruments | Instruments
[**getLeverage()**](AccountApi.md#getLeverage) | **POST** /accounts/{accountId}/getLeverage | Get Leverage
[**getOrders()**](AccountApi.md#getOrders) | **GET** /accounts/{accountId}/orders | Orders
[**getOrdersHistory()**](AccountApi.md#getOrdersHistory) | **GET** /accounts/{accountId}/ordersHistory | Orders History
[**getPositions()**](AccountApi.md#getPositions) | **GET** /accounts/{accountId}/positions | Positions
[**getState()**](AccountApi.md#getState) | **GET** /accounts/{accountId}/state | State
[**previewLeverage()**](AccountApi.md#previewLeverage) | **POST** /accounts/{accountId}/previewLeverage | Preview Leverage
[**setLeverage()**](AccountApi.md#setLeverage) | **POST** /accounts/{accountId}/setLeverage | Set Leverage


## `getAccounts()`

```php
getAccounts($locale): OneOfAccountResponseErrorResponse
```

Accounts

Get a list of accounts owned by the user.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.

try {
    $result = $apiInstance->getAccounts($locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getAccounts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |

### Return type

[**OneOfAccountResponseErrorResponse**](../Model/OneOfAccountResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getBalances()`

```php
getBalances($account_id, $locale): OneOfCryptoBalancesResponseErrorResponse
```

Balances

Get crypto balances for an account. Balances are displayed as the first table of the Account Summary tab. Used for crypto currencies only.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.

try {
    $result = $apiInstance->getBalances($account_id, $locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getBalances: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |

### Return type

[**OneOfCryptoBalancesResponseErrorResponse**](../Model/OneOfCryptoBalancesResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getExecutions()`

```php
getExecutions($account_id, $locale, $instrument, $max_count): OneOfExecutionsResponseErrorResponse
```

Executions

Get a list of executions (i.e. fills or trades) for an account and an instrument. Executions are displayed on a chart.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$instrument = 'instrument_example'; // string | Broker instrument name.
$max_count = 3.4; // float | Maximum count of executions to return.

try {
    $result = $apiInstance->getExecutions($account_id, $locale, $instrument, $max_count);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getExecutions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **instrument** | **string**| Broker instrument name. |
 **max_count** | **float**| Maximum count of executions to return. | [optional]

### Return type

[**OneOfExecutionsResponseErrorResponse**](../Model/OneOfExecutionsResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getInstruments()`

```php
getInstruments($account_id, $locale): OneOfInstrumentsResponseErrorResponse
```

Instruments

Get the list of the instruments that are available for trading with the specified account.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.

try {
    $result = $apiInstance->getInstruments($account_id, $locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getInstruments: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |

### Return type

[**OneOfInstrumentsResponseErrorResponse**](../Model/OneOfInstrumentsResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLeverage()`

```php
getLeverage($account_id, $locale, $instrument, $side, $order_type): OneOfGetLeverageResponseErrorResponse
```

Get Leverage

Request to this endpoint will be sent when the user opens the order ticket or changes any of the symbol, order type, side and any of the custom fields in the order ticket. Custom `Order dialog` fields defined in the [/accounts](#operation/getAccounts) are sent along with the standard fields in the order object.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$instrument = 'instrument_example'; // string | Broker instrument name.
$side = 'side_example'; // string | Current order side in the order ticket.
$order_type = 'order_type_example'; // string | Current order type selected in the order ticket.

try {
    $result = $apiInstance->getLeverage($account_id, $locale, $instrument, $side, $order_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getLeverage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **instrument** | **string**| Broker instrument name. |
 **side** | **string**| Current order side in the order ticket. |
 **order_type** | **string**| Current order type selected in the order ticket. |

### Return type

[**OneOfGetLeverageResponseErrorResponse**](../Model/OneOfGetLeverageResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrders()`

```php
getOrders($account_id, $locale): OneOfOrdersResponseErrorResponse
```

Orders

Get current session orders for the account. It also includes working orders from previous sessions. Filled/cancelled/rejected orders should be included in the list till the end of the session.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.

try {
    $result = $apiInstance->getOrders($account_id, $locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getOrders: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |

### Return type

[**OneOfOrdersResponseErrorResponse**](../Model/OneOfOrdersResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getOrdersHistory()`

```php
getOrdersHistory($account_id, $locale, $max_count): OneOfOrdersHistoryResponseErrorResponse
```

Orders History

Get order history for an account. It is expected that returned orders will have a final status (`rejected`, `filled`, `cancelled`). This endpoint is optional. If you don't support orders history, please set the `supportOrdersHistory` flag to `false`.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$max_count = 3.4; // float | Maximum count of orders to return.

try {
    $result = $apiInstance->getOrdersHistory($account_id, $locale, $max_count);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getOrdersHistory: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **max_count** | **float**| Maximum count of orders to return. | [optional]

### Return type

[**OneOfOrdersHistoryResponseErrorResponse**](../Model/OneOfOrdersHistoryResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPositions()`

```php
getPositions($account_id, $locale): OneOfPositionsResponseErrorResponse
```

Positions

Get positions for an account.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.

try {
    $result = $apiInstance->getPositions($account_id, $locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getPositions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |

### Return type

[**OneOfPositionsResponseErrorResponse**](../Model/OneOfPositionsResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getState()`

```php
getState($account_id, $locale): OneOfAccountStateResponseErrorResponse
```

State

Get account information.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.

try {
    $result = $apiInstance->getState($account_id, $locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getState: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |

### Return type

[**OneOfAccountStateResponseErrorResponse**](../Model/OneOfAccountStateResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `previewLeverage()`

```php
previewLeverage($account_id, $locale, $instrument, $side, $order_type, $leverage): OneOfPreviewLeverageResponseErrorResponse
```

Preview Leverage

Will be sent when the user is editing the leverage. Custom `Order dialog` fields defined in the [/accounts](#operation/getAccounts) are sent along with the standard fields in the order object.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$instrument = 'instrument_example'; // string | Broker instrument name.
$side = 'side_example'; // string | Current order side in the order ticket.
$order_type = 'order_type_example'; // string | Current order type selected in the order ticket.
$leverage = 3.4; // float | Leverage value set by user

try {
    $result = $apiInstance->previewLeverage($account_id, $locale, $instrument, $side, $order_type, $leverage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->previewLeverage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **instrument** | **string**| Broker instrument name. |
 **side** | **string**| Current order side in the order ticket. |
 **order_type** | **string**| Current order type selected in the order ticket. |
 **leverage** | **float**| Leverage value set by user |

### Return type

[**OneOfPreviewLeverageResponseErrorResponse**](../Model/OneOfPreviewLeverageResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setLeverage()`

```php
setLeverage($account_id, $locale, $instrument, $side, $order_type, $leverage): OneOfSetLeverageResponseErrorResponse
```

Set Leverage

Will be sent when the user confirms changing the leverage. Additional \"leverage\" field will be added to the payload, the value of which was set by the user. Custom `Order dialog` fields defined in the [/accounts](#operation/getAccounts) are sent along with the standard fields in the order object.

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$instrument = 'instrument_example'; // string | Broker instrument name.
$side = 'side_example'; // string | Current order side in the order ticket.
$order_type = 'order_type_example'; // string | Current order type selected in the order ticket.
$leverage = 3.4; // float | Leverage value set by the user

try {
    $result = $apiInstance->setLeverage($account_id, $locale, $instrument, $side, $order_type, $leverage);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->setLeverage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **instrument** | **string**| Broker instrument name. |
 **side** | **string**| Current order side in the order ticket. |
 **order_type** | **string**| Current order type selected in the order ticket. |
 **leverage** | **float**| Leverage value set by the user |

### Return type

[**OneOfSetLeverageResponseErrorResponse**](../Model/OneOfSetLeverageResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
