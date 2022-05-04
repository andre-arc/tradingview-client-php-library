# OpenAPI\Client\TradingApi

All URIs are relative to https://your-rest-implementation.com/api.

Method | HTTP request | Description
------------- | ------------- | -------------
[**cancelOrder()**](TradingApi.md#cancelOrder) | **DELETE** /accounts/{accountId}/orders/{orderId} | Cancel Order
[**closePosition()**](TradingApi.md#closePosition) | **DELETE** /accounts/{accountId}/positions/{positionId} | Close Position
[**modifyOrder()**](TradingApi.md#modifyOrder) | **PUT** /accounts/{accountId}/orders/{orderId} | Modify Order
[**modifyPosition()**](TradingApi.md#modifyPosition) | **PUT** /accounts/{accountId}/positions/{positionId} | Modify Position
[**placeOrder()**](TradingApi.md#placeOrder) | **POST** /accounts/{accountId}/orders | Place Order
[**previewOrder()**](TradingApi.md#previewOrder) | **POST** /accounts/{accountId}/previewOrder | Preview Order


## `cancelOrder()`

```php
cancelOrder($account_id, $order_id, $locale): OneOfSuccessResponseErrorResponse
```

Cancel Order

Cancel an existing order.

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


$apiInstance = new OpenAPI\Client\Api\TradingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$order_id = 'order_id_example'; // string | Order identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.

try {
    $result = $apiInstance->cancelOrder($account_id, $order_id, $locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TradingApi->cancelOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **order_id** | **string**| Order identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |

### Return type

[**OneOfSuccessResponseErrorResponse**](../Model/OneOfSuccessResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `closePosition()`

```php
closePosition($account_id, $position_id, $locale, $amount): OneOfSuccessResponseErrorResponse
```

Close Position

Close an existing position.

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


$apiInstance = new OpenAPI\Client\Api\TradingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$position_id = 'position_id_example'; // string | Position identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$amount = 3.4; // float | Amount to close. This property is used if supportPartialClosePosition flag is `true`.

try {
    $result = $apiInstance->closePosition($account_id, $position_id, $locale, $amount);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TradingApi->closePosition: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **position_id** | **string**| Position identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **amount** | **float**| Amount to close. This property is used if supportPartialClosePosition flag is &#x60;true&#x60;. | [optional]

### Return type

[**OneOfSuccessResponseErrorResponse**](../Model/OneOfSuccessResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `modifyOrder()`

```php
modifyOrder($account_id, $order_id, $locale, $qty, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid): OneOfSuccessResponseErrorResponse
```

Modify Order

Modify an existing order. Custom `Order dialog` fields defined in the [/accounts](#operation/getAccounts) are sent along with the standard fields in the order object.

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


$apiInstance = new OpenAPI\Client\Api\TradingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$order_id = 'order_id_example'; // string | Order identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$qty = 3.4; // float | The number of units.
$confirm_id = 'confirm_id_example'; // string | Identifier of an order received in the preview order request.
$limit_price = 3.4; // float | Limit Price for Limit or StopLimit order.
$stop_price = 3.4; // float | Stop Price for Stop or StopLimit order.
$duration_type = 'duration_type_example'; // string | Duration ID (if supported).
$duration_date_time = 3.4; // float | Expiration datetime Unix timestamp (if supported by duration type).
$stop_loss = 3.4; // float | StopLoss price (if supported).
$trailing_stop_pips = 3.4; // float | Distance from the stop loss level to the current market price in pips (if supported by the broker).
$take_profit = 3.4; // float | TakeProfit price (if supported).
$digital_signature = 'digital_signature_example'; // string | Digital signature (if supported).
$current_ask = 3.4; // float | Current ask price for the instrument that the user sees in the order panel.
$current_bid = 3.4; // float | Current bid price for the instrument that the user sees in the order panel.

try {
    $result = $apiInstance->modifyOrder($account_id, $order_id, $locale, $qty, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TradingApi->modifyOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **order_id** | **string**| Order identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **qty** | **float**| The number of units. |
 **confirm_id** | **string**| Identifier of an order received in the preview order request. | [optional]
 **limit_price** | **float**| Limit Price for Limit or StopLimit order. | [optional]
 **stop_price** | **float**| Stop Price for Stop or StopLimit order. | [optional]
 **duration_type** | **string**| Duration ID (if supported). | [optional]
 **duration_date_time** | **float**| Expiration datetime Unix timestamp (if supported by duration type). | [optional]
 **stop_loss** | **float**| StopLoss price (if supported). | [optional]
 **trailing_stop_pips** | **float**| Distance from the stop loss level to the current market price in pips (if supported by the broker). | [optional]
 **take_profit** | **float**| TakeProfit price (if supported). | [optional]
 **digital_signature** | **string**| Digital signature (if supported). | [optional]
 **current_ask** | **float**| Current ask price for the instrument that the user sees in the order panel. | [optional]
 **current_bid** | **float**| Current bid price for the instrument that the user sees in the order panel. | [optional]

### Return type

[**OneOfSuccessResponseErrorResponse**](../Model/OneOfSuccessResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `modifyPosition()`

```php
modifyPosition($account_id, $position_id, $locale, $side, $stop_loss, $trailing_stop_pips, $take_profit): OneOfSuccessResponseErrorResponse
```

Modify Position

Modify an existing position stop loss or take profit or both.

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


$apiInstance = new OpenAPI\Client\Api\TradingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$position_id = 'position_id_example'; // string | Position identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$side = 'side_example'; // string | New side of the position. This parameter is used to reverse the position, if the `supportNativeReversePosition` flag is enabled in the account config. Please see the [/accounts](#operation/getAccounts) endpoint.
$stop_loss = 3.4; // float | StopLoss price.
$trailing_stop_pips = 3.4; // float | Distance from the stop loss level to the order price in pips.
$take_profit = 3.4; // float | TakeProfit price.

try {
    $result = $apiInstance->modifyPosition($account_id, $position_id, $locale, $side, $stop_loss, $trailing_stop_pips, $take_profit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TradingApi->modifyPosition: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **position_id** | **string**| Position identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **side** | **string**| New side of the position. This parameter is used to reverse the position, if the &#x60;supportNativeReversePosition&#x60; flag is enabled in the account config. Please see the [/accounts](#operation/getAccounts) endpoint. | [optional]
 **stop_loss** | **float**| StopLoss price. | [optional]
 **trailing_stop_pips** | **float**| Distance from the stop loss level to the order price in pips. | [optional]
 **take_profit** | **float**| TakeProfit price. | [optional]

### Return type

[**OneOfSuccessResponseErrorResponse**](../Model/OneOfSuccessResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `placeOrder()`

```php
placeOrder($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature): OneOfPostOrderResponseErrorResponse
```

Place Order

Place a new order. Custom `Order dialog` fields defined in the [/accounts](#operation/getAccounts) are sent along with the standard fields in the order object.

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


$apiInstance = new OpenAPI\Client\Api\TradingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$instrument = 'instrument_example'; // string | Instrument.
$side = 'side_example'; // string | Side.
$type = 'type_example'; // string | Type.
$qty = 3.4; // float | The number of units.
$current_ask = 3.4; // float | Current ask price for the instrument that the user sees in the order panel.
$current_bid = 3.4; // float | Current bid price for the instrument that the user sees in the order panel.
$request_id = 23425678343; // string | Unique identifier for a request.
$confirm_id = 'confirm_id_example'; // string | Identifier of an order received in the preview order request.
$limit_price = 3.4; // float | Limit Price for Limit or StopLimit order.
$stop_price = 3.4; // float | Stop Price for Stop or StopLimit order.
$duration_type = 'duration_type_example'; // string | Duration ID (if supported).
$duration_date_time = 3.4; // float | Expiration datetime Unix timestamp (if supported by duration type).
$stop_loss = 3.4; // float | StopLoss price (if supported).
$trailing_stop_pips = 3.4; // float | Distance from the stop loss level to the current market price in pips (if supported by the broker).
$take_profit = 3.4; // float | TakeProfit price (if supported).
$digital_signature = 'digital_signature_example'; // string | Digital signature (if supported).

try {
    $result = $apiInstance->placeOrder($account_id, $locale, $instrument, $side, $type, $qty, $current_ask, $current_bid, $request_id, $confirm_id, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TradingApi->placeOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **instrument** | **string**| Instrument. |
 **side** | **string**| Side. |
 **type** | **string**| Type. |
 **qty** | **float**| The number of units. |
 **current_ask** | **float**| Current ask price for the instrument that the user sees in the order panel. |
 **current_bid** | **float**| Current bid price for the instrument that the user sees in the order panel. |
 **request_id** | **string**| Unique identifier for a request. | [optional]
 **confirm_id** | **string**| Identifier of an order received in the preview order request. | [optional]
 **limit_price** | **float**| Limit Price for Limit or StopLimit order. | [optional]
 **stop_price** | **float**| Stop Price for Stop or StopLimit order. | [optional]
 **duration_type** | **string**| Duration ID (if supported). | [optional]
 **duration_date_time** | **float**| Expiration datetime Unix timestamp (if supported by duration type). | [optional]
 **stop_loss** | **float**| StopLoss price (if supported). | [optional]
 **trailing_stop_pips** | **float**| Distance from the stop loss level to the current market price in pips (if supported by the broker). | [optional]
 **take_profit** | **float**| TakeProfit price (if supported). | [optional]
 **digital_signature** | **string**| Digital signature (if supported). | [optional]

### Return type

[**OneOfPostOrderResponseErrorResponse**](../Model/OneOfPostOrderResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `previewOrder()`

```php
previewOrder($account_id, $locale, $qty, $instrument, $side, $type, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid, $id): OneOfPreviewOrderResponseErrorResponse
```

Preview Order

Get estimated cost, commission and other information for an order without the order actually being placed or modified. This information is displayed in the Order Ticket Preview. This endpoint is used if supportPlaceOrderPreview and/or supportModifyOrderPreview flag is `true`. TradingView displays the following information by itself&#58; symbol, bid/ask, order type, side, quantity, price (except market orders), stop loss, take profit and currency. Custom `Order dialog` fields defined in the [/accounts](#operation/getAccounts) are sent along with the standard fields in the order object.

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


$apiInstance = new OpenAPI\Client\Api\TradingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$account_id = 'account_id_example'; // string | Account identifier.
$locale = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale | Locale (language) id.
$qty = 3.4; // float | The number of units.
$instrument = 'instrument_example'; // string | Instrument.
$side = 'side_example'; // string | Side.
$type = 'type_example'; // string | Type.
$limit_price = 3.4; // float | Limit Price for Limit or StopLimit order.
$stop_price = 3.4; // float | Stop Price for Stop or StopLimit order.
$duration_type = 'duration_type_example'; // string | Duration ID (if supported).
$duration_date_time = 3.4; // float | Expiration datetime Unix timestamp (if supported by duration type).
$stop_loss = 3.4; // float | StopLoss price (if supported).
$trailing_stop_pips = 3.4; // float | Distance from the stop loss level to the current market price in pips (if supported by the broker).
$take_profit = 3.4; // float | TakeProfit price (if supported).
$digital_signature = 'digital_signature_example'; // string | Digital signature (if supported).
$current_ask = 3.4; // float | Current ask price for the instrument that the user sees in the order panel.
$current_bid = 3.4; // float | Current bid price for the instrument that the user sees in the order panel.
$id = 'id_example'; // string | Identifier of the order that is being modified by the user. This parameter is sent only if `supportModifyOrderPreview` flag is `true`.

try {
    $result = $apiInstance->previewOrder($account_id, $locale, $qty, $instrument, $side, $type, $limit_price, $stop_price, $duration_type, $duration_date_time, $stop_loss, $trailing_stop_pips, $take_profit, $digital_signature, $current_ask, $current_bid, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TradingApi->previewOrder: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**| Account identifier. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/.md)| Locale (language) id. |
 **qty** | **float**| The number of units. |
 **instrument** | **string**| Instrument. |
 **side** | **string**| Side. |
 **type** | **string**| Type. |
 **limit_price** | **float**| Limit Price for Limit or StopLimit order. | [optional]
 **stop_price** | **float**| Stop Price for Stop or StopLimit order. | [optional]
 **duration_type** | **string**| Duration ID (if supported). | [optional]
 **duration_date_time** | **float**| Expiration datetime Unix timestamp (if supported by duration type). | [optional]
 **stop_loss** | **float**| StopLoss price (if supported). | [optional]
 **trailing_stop_pips** | **float**| Distance from the stop loss level to the current market price in pips (if supported by the broker). | [optional]
 **take_profit** | **float**| TakeProfit price (if supported). | [optional]
 **digital_signature** | **string**| Digital signature (if supported). | [optional]
 **current_ask** | **float**| Current ask price for the instrument that the user sees in the order panel. | [optional]
 **current_bid** | **float**| Current bid price for the instrument that the user sees in the order panel. | [optional]
 **id** | **string**| Identifier of the order that is being modified by the user. This parameter is sent only if &#x60;supportModifyOrderPreview&#x60; flag is &#x60;true&#x60;. | [optional]

### Return type

[**OneOfPreviewOrderResponseErrorResponse**](../Model/OneOfPreviewOrderResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
