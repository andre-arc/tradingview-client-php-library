# OpenAPI\Client\DataPermissionsApi

All URIs are relative to https://your-rest-implementation.com/api.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getGroups()**](DataPermissionsApi.md#getGroups) | **GET** /groups | Groups
[**getPermissions()**](DataPermissionsApi.md#getPermissions) | **GET** /permissions | Permissions


## `getGroups()`

```php
getGroups(): OneOfGroupListResponseErrorResponse
```

Groups

Get a list of possible groups of symbols. A group is a set of symbols that share a common access level. Any user can have access to any number of such groups. It is required only if you use groups of symbols in order to restrict access to the instrument's data.  **IMPORTANT:** Please plan your symbol grouping carefully. Groups cannot be deleted, you can only remove all the symbols from there.  **LIMITATIONS:** Each integration is limited to have up to 10 symbol groups. Each symbol group is limited to have up to 10K symbols in it. You cannot put the same symbol into 2 different groups.  This endpoint allows you to specify a list of groups, and the [/permissions](#operation/getPermissions) endpoint specifies which groups are available for the certain user.  When TradingView user logs into his broker account - he will gain access to one or more groups, depending on the [/permissions](#operation/getPermissions) endpoint.  At the [/symbol_info](#operation/getSymbolInfo) endpoint TradingView adds the GET argument `group` with the name of the group. Thus, TradingView will receive information about which group each symbol belongs to.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (Bearer ACCESS_TOKEN) authorization: PasswordBearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: ServerOAuth2Bearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\DataPermissionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getGroups();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataPermissionsApi->getGroups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**OneOfGroupListResponseErrorResponse**](../Model/OneOfGroupListResponseErrorResponse.md)

### Authorization

[PasswordBearer](../../README.md#PasswordBearer), [ServerOAuth2Bearer](../../README.md#ServerOAuth2Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPermissions()`

```php
getPermissions(): OneOfPermissionsResponseErrorResponse
```

Permissions

Get a list of symbol groups allowed for the user. It is only required if you use groups of symbols to restrict access to instrument's data.

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


$apiInstance = new OpenAPI\Client\Api\DataPermissionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getPermissions();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DataPermissionsApi->getPermissions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**OneOfPermissionsResponseErrorResponse**](../Model/OneOfPermissionsResponseErrorResponse.md)

### Authorization

[OAuth2Bearer](../../README.md#OAuth2Bearer), [OAuth2Bearer](../../README.md#OAuth2Bearer), [PasswordBearer](../../README.md#PasswordBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
