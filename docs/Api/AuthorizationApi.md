# OpenAPI\Client\AuthorizationApi

All URIs are relative to https://your-rest-implementation.com/api.

Method | HTTP request | Description
------------- | ------------- | -------------
[**authorize()**](AuthorizationApi.md#authorize) | **POST** /authorize | Authorize
[**logout()**](AuthorizationApi.md#logout) | **POST** /logout | Logout


## `authorize()`

```php
authorize($login, $password, $locale): OneOfAuthorizeResponseErrorResponse
```

Authorize

Username and password authentication.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\AuthorizationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$login = 'login_example'; // string | User login.
$password = 'password_example'; // string | User password.
$locale = new \OpenAPI\Client\Model\Locale(); // \OpenAPI\Client\Model\Locale

try {
    $result = $apiInstance->authorize($login, $password, $locale);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationApi->authorize: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **login** | **string**| User login. |
 **password** | **string**| User password. |
 **locale** | [**\OpenAPI\Client\Model\Locale**](../Model/Locale.md)|  |

### Return type

[**OneOfAuthorizeResponseErrorResponse**](../Model/OneOfAuthorizeResponseErrorResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/x-www-form-urlencoded`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `logout()`

```php
logout(): OneOfSuccessResponseErrorResponse
```

Logout

Send logout if the supportLogout flag is set as true.

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


$apiInstance = new OpenAPI\Client\Api\AuthorizationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->logout();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthorizationApi->logout: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

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
