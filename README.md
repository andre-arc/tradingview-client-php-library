# OpenAPIClient-php

## Overview
  This API is to be implemented by the Brokers in order to connect their backend systems to TradingView, that acts as a frontend.

  Check the [info page](https://www.tradingview.com/brokerage-integration/) for more info and use the contact form there if you have any questions.

  ### Types of requests
  There are two types of requests — client and server.
  Client requests are executed at the browser. Server requests are initiated from the TradingView servers.
  If your integration does not imply brokerage data stream connection to the TradingView website -
  then there won't be any server requests.

  #### Clients requests
  From the browser TradingView requests the info (list of orders and positions, balance info, etc.) from the broker’s server.
  The requests are sent periodically and the intervals can be set by using the [/config](#operation/getConfiguration) endpoint.
  After that, TradingView compares the new data with the previous answer and calculates the difference.
  If the status of the order/position changes or new data appears - the user will see a notification and the changes
  will display in the Account manager on the website.

  Requests to the [endpoints](/rest-api-spec/#tag/Trading) for placing/modifying orders, positions closing, etc. occur only after actions made by the user.

  The [/quotes](#operation/getQuotes) endpoint retrieves the current bid/ask from the broker.
  The [/depth](#operation/getDepth) endpoint retrieves Level 2 market data.

  #### Server requests
  In case if a Broker provides any Forex or CFD trading access for its clients it will require connection
  of its own market data at TradingView. In order to make it possible, you will need to implement the following endpoints -
    [/symbol_info](#operation/getSymbolInfo), [/history](#operation/getHistory) and [/streaming](#operation/streaming).
  Data requests are sent from different TradingView servers. Usually, at least 4 servers are used.
  The historical data is cached on TradingView servers and loaded to the client browser from our servers.

  ### Restricting access to data
  By default, the broker symbols will be available in the symbol search at TradingView and all the community
  will have access to your data streams without any limitation. In order to limit the access to your data streams
  please use the following endpoints - [/groups](#operation/getGroups) and [/permissions](#operation/getPermissions).

  You can find more information about restricting access to the data in the description of these endpoints.

  ### Change log
  1.3.27. Added `hardToBorrow`, `notShortable`, `halted` parameters to the [/quotes](#operation/getQuotes) endpoint.

  1.3.26. In [/symbol_info](#operation/getSymbolInfo), the `minmov2` property renamed to `minmovement2`, the `Etc/UTC`
    timezone added. In [/history ](#operation/getHistory), the `HistoryNextBarResponse` response changed to
    `HistoryEmptyBarResponse`, the `countback` query parameter became deprecated.
    In [/accounts](#operation/getAccounts), added the `isVerified` property.

  1.3.25. Added `locale` parameter to the [/authorize](#operation/authorize) endpoint.

  1.3.24. Added leverage support. Added new `supportLeverage` flag. Added three new endpoints:
    [/getLeverage](#operation/getLeverage), [/setLeverage](#operation/setLeverage) and [/previewLeverage](#operation/previewLeverage).

  1.3.23. Changed description of `forceUserEnterInitialValue` flag in the `OrderDialogCustomFields` parameters.

  1.3.22. Added new flags - `supportModifyOrderPrice` and `supportModifyBrackets`. The `supportModifyOrder` flag became deprecated.

  1.3.21. Added new `units` field to the [/instruments](#operation/getInstruments) endpoint.

  1.3.20. Added new `supportTrailingStop` flag. Added support for trailing stops for orders and positions.

  1.3.19. Added new `logout` endpoint, `supportLogout` flag.

  1.3.18. Added new `supportPartialClosePosition` flag and `amount` field to the [/closePosition](#operation/closePosition)
    endpoint parameters.

  1.3.17. Added `stopPercent` and `limitPercent` validation rules to the [/instruments](#operation/getInstruments) endpoint.

  1.3.16. Added new `supportOrderHistoryCustomFields` flag and `orderHistoryCustomFields` field to the `ui` object
    in the [/accounts](#operation/getAccounts) endpoint and [/config](#operation/getConfiguration).

  1.3.15. Added `supportedOrderTypes` field to the `Duration` parameters.

  1.3.14. Added `isCapitalize` field to the `positionCustomFields` and `orderCustomFields` parameters.

  1.3.13. Added rules parameter to the [/instruments](#operation/getInstruments) endpoint.

  1.3.12. Added `prefix` field to the `Account` parameters.

  1.3.11. Changed description for [/placeOrder](#operation/placeOrder), [/modifyOrder](#operation/modifyOrder),
    [/previewOrder](#operation/previewOrder), `OrderDialogCustomFields` and `customFields` field in `OrderCommon`.

  1.3.10. Added `locale` query parameter to [/getOrders](#operation/getOrders), [/placeOrder](#operation/placeOrder),
    [/modifyOrder](#operation/modifyOrder), [/cancelOrder](#operation/cancelOrder), [/getPositions](#operation/getPositions),
    [/modifyPosition](#operation/modifyPosition), [/closePosition](#operation/closePosition),
    [/getExecutions](#operation/getExecutions), [/getOrdersHistory](#operation/getOrdersHistory),
    [/getQuotes](#operation/getQuotes), [/getDepth](#operation/getDepth) and [/getBalances](#operation/getBalances) endpoints.

  1.3.9. Added `orderId`, `isClose`, `positionId` and `commission` fields to Execution.

  1.3.8. Added `id` field to the [/previewOrder](#operation/previewOrder) endpoint parameters.

  1.3.7. Added `mutable` field to the `OrderDialogCustomFields` parameters.

  1.3.6. Added `lang` query parameter to OAuth authorization request.

  1.3.5. Added `accountId` query parameter to `depth` endpoint.

  1.3.4. Added Order dialog customization opportunity on the instrument basis. Moved `OrderDialogCustomFields` to
    the `ui` object in the [/accounts](#operation/getAccounts) endpoint.

  1.3.3. Added new `supportStopOrdersInBothDirections` flag.

  1.3.2. Added new `previewOrder` endpoint, `supportPlaceOrderPreview` and `supportModifyOrderPreview ` flags.

  1.3.1. Added OAuth 2 Code Flow.

  1.3.0. Added overriding Account manager and Durations configuration on Account basis.

  1.2.5. Added `reserved`, `value` and `valueCurrency` fields to Crypto Balances.

  1.2.4. Added default values to the account flags. Added `supportMarketBrackets` account flag.

  1.2.3. Added current ask/bid fields to the parameters of the order [placement](#operation/placeOrder)
  and [modification](#operation/modifyPosition) requests.

  1.2.2. Added supportPartialOrderExecution flag.

  1.2.1. Added support for position's and order's Custom fields. Removed `fixedWidth` and `sortable` fields from `AccountManagerColumn`.

  1.2.0. Introducing new Quote response. Deprecation of streaming Bid and Ask responses.
  All new integrations should use the Quote response to provide ask/bid values.
  Added supportMarketOrders, supportLimitOrders, supportStop orders account flags.
  Added informational message to order and position.

  1.1.3. Added support for reverse of the position.

  1.1.2. Added support for custom Account Summary Row.

  1.1.1. Added `type` field to [/accounts](#operation/getAccounts) endpoint.

  1.1.0. Refactor, added examples.



## Installation & Usage

### Requirements

PHP 7.3 and later.
Should also work with PHP 8.0 but has not been tested.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## API Endpoints

All URIs are relative to *https://your-rest-implementation.com/api*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AccountApi* | [**getAccounts**](docs/Api/AccountApi.md#getaccounts) | **GET** /accounts | Accounts
*AccountApi* | [**getBalances**](docs/Api/AccountApi.md#getbalances) | **GET** /accounts/{accountId}/balances | Balances
*AccountApi* | [**getExecutions**](docs/Api/AccountApi.md#getexecutions) | **GET** /accounts/{accountId}/executions | Executions
*AccountApi* | [**getInstruments**](docs/Api/AccountApi.md#getinstruments) | **GET** /accounts/{accountId}/instruments | Instruments
*AccountApi* | [**getLeverage**](docs/Api/AccountApi.md#getleverage) | **POST** /accounts/{accountId}/getLeverage | Get Leverage
*AccountApi* | [**getOrders**](docs/Api/AccountApi.md#getorders) | **GET** /accounts/{accountId}/orders | Orders
*AccountApi* | [**getOrdersHistory**](docs/Api/AccountApi.md#getordershistory) | **GET** /accounts/{accountId}/ordersHistory | Orders History
*AccountApi* | [**getPositions**](docs/Api/AccountApi.md#getpositions) | **GET** /accounts/{accountId}/positions | Positions
*AccountApi* | [**getState**](docs/Api/AccountApi.md#getstate) | **GET** /accounts/{accountId}/state | State
*AccountApi* | [**previewLeverage**](docs/Api/AccountApi.md#previewleverage) | **POST** /accounts/{accountId}/previewLeverage | Preview Leverage
*AccountApi* | [**setLeverage**](docs/Api/AccountApi.md#setleverage) | **POST** /accounts/{accountId}/setLeverage | Set Leverage
*AuthorizationApi* | [**authorize**](docs/Api/AuthorizationApi.md#authorize) | **POST** /authorize | Authorize
*AuthorizationApi* | [**logout**](docs/Api/AuthorizationApi.md#logout) | **POST** /logout | Logout
*BrokerConfigurationApi* | [**getConfiguration**](docs/Api/BrokerConfigurationApi.md#getconfiguration) | **GET** /config | Configuration
*BrokerConfigurationApi* | [**getMapping**](docs/Api/BrokerConfigurationApi.md#getmapping) | **GET** /mapping | Mapping
*DataIntegrationApi* | [**getHistory**](docs/Api/DataIntegrationApi.md#gethistory) | **GET** /history | History
*DataIntegrationApi* | [**getSymbolInfo**](docs/Api/DataIntegrationApi.md#getsymbolinfo) | **GET** /symbol_info | Symbol Info
*DataIntegrationApi* | [**streaming**](docs/Api/DataIntegrationApi.md#streaming) | **GET** /streaming | Stream of prices
*DataPermissionsApi* | [**getGroups**](docs/Api/DataPermissionsApi.md#getgroups) | **GET** /groups | Groups
*DataPermissionsApi* | [**getPermissions**](docs/Api/DataPermissionsApi.md#getpermissions) | **GET** /permissions | Permissions
*MarketDataApi* | [**getDepth**](docs/Api/MarketDataApi.md#getdepth) | **GET** /depth | Depth
*MarketDataApi* | [**getQuotes**](docs/Api/MarketDataApi.md#getquotes) | **GET** /quotes | Quotes
*TradingApi* | [**cancelOrder**](docs/Api/TradingApi.md#cancelorder) | **DELETE** /accounts/{accountId}/orders/{orderId} | Cancel Order
*TradingApi* | [**closePosition**](docs/Api/TradingApi.md#closeposition) | **DELETE** /accounts/{accountId}/positions/{positionId} | Close Position
*TradingApi* | [**modifyOrder**](docs/Api/TradingApi.md#modifyorder) | **PUT** /accounts/{accountId}/orders/{orderId} | Modify Order
*TradingApi* | [**modifyPosition**](docs/Api/TradingApi.md#modifyposition) | **PUT** /accounts/{accountId}/positions/{positionId} | Modify Position
*TradingApi* | [**placeOrder**](docs/Api/TradingApi.md#placeorder) | **POST** /accounts/{accountId}/orders | Place Order
*TradingApi* | [**previewOrder**](docs/Api/TradingApi.md#previeworder) | **POST** /accounts/{accountId}/previewOrder | Preview Order

## Models

- [AccessToken](docs/Model/AccessToken.md)
- [Account](docs/Model/Account.md)
- [AccountFlags](docs/Model/AccountFlags.md)
- [AccountManagerColumn](docs/Model/AccountManagerColumn.md)
- [AccountManagerTable](docs/Model/AccountManagerTable.md)
- [AccountResponse](docs/Model/AccountResponse.md)
- [AccountState](docs/Model/AccountState.md)
- [AccountStateResponse](docs/Model/AccountStateResponse.md)
- [AccountSummaryRowItem](docs/Model/AccountSummaryRowItem.md)
- [AccountUi](docs/Model/AccountUi.md)
- [AuthorizeResponse](docs/Model/AuthorizeResponse.md)
- [BarsArrays](docs/Model/BarsArrays.md)
- [ComboBoxMetaInfo](docs/Model/ComboBoxMetaInfo.md)
- [ComboBoxValue](docs/Model/ComboBoxValue.md)
- [Config](docs/Model/Config.md)
- [ConfigResponse](docs/Model/ConfigResponse.md)
- [CryptoBalance](docs/Model/CryptoBalance.md)
- [CryptoBalancesResponse](docs/Model/CryptoBalancesResponse.md)
- [CustomFieldsValueItem](docs/Model/CustomFieldsValueItem.md)
- [Depth](docs/Model/Depth.md)
- [DepthResponse](docs/Model/DepthResponse.md)
- [Duration](docs/Model/Duration.md)
- [EmptyBarArrays](docs/Model/EmptyBarArrays.md)
- [ErrorResponse](docs/Model/ErrorResponse.md)
- [Execution](docs/Model/Execution.md)
- [ExecutionsResponse](docs/Model/ExecutionsResponse.md)
- [GetLeverage](docs/Model/GetLeverage.md)
- [GetLeverageResponse](docs/Model/GetLeverageResponse.md)
- [GroupList](docs/Model/GroupList.md)
- [GroupListGroups](docs/Model/GroupListGroups.md)
- [GroupListResponse](docs/Model/GroupListResponse.md)
- [HistoryEmptyBarResponse](docs/Model/HistoryEmptyBarResponse.md)
- [HistoryNoDataResponse](docs/Model/HistoryNoDataResponse.md)
- [HistorySuccessResponse](docs/Model/HistorySuccessResponse.md)
- [Instrument](docs/Model/Instrument.md)
- [InstrumentUi](docs/Model/InstrumentUi.md)
- [InstrumentsResponse](docs/Model/InstrumentsResponse.md)
- [LimitPercentValidationRule](docs/Model/LimitPercentValidationRule.md)
- [LimitPercentValidationRuleOptions](docs/Model/LimitPercentValidationRuleOptions.md)
- [Locale](docs/Model/Locale.md)
- [Message](docs/Model/Message.md)
- [OkStatus](docs/Model/OkStatus.md)
- [Order](docs/Model/Order.md)
- [OrderCommon](docs/Model/OrderCommon.md)
- [OrderCommonDuration](docs/Model/OrderCommonDuration.md)
- [OrderDialogCustomFields](docs/Model/OrderDialogCustomFields.md)
- [OrderHistory](docs/Model/OrderHistory.md)
- [OrderHistoryStatus](docs/Model/OrderHistoryStatus.md)
- [OrderPreviewSection](docs/Model/OrderPreviewSection.md)
- [OrderPreviewSectionRow](docs/Model/OrderPreviewSectionRow.md)
- [OrderStatus](docs/Model/OrderStatus.md)
- [OrdersHistoryResponse](docs/Model/OrdersHistoryResponse.md)
- [OrdersResponse](docs/Model/OrdersResponse.md)
- [PermissionGroups](docs/Model/PermissionGroups.md)
- [PermissionsResponse](docs/Model/PermissionsResponse.md)
- [Position](docs/Model/Position.md)
- [PositionsResponse](docs/Model/PositionsResponse.md)
- [PostOrderResponse](docs/Model/PostOrderResponse.md)
- [PostOrderResponseD](docs/Model/PostOrderResponseD.md)
- [PreviewLeverage](docs/Model/PreviewLeverage.md)
- [PreviewLeverageResponse](docs/Model/PreviewLeverageResponse.md)
- [PreviewOrder](docs/Model/PreviewOrder.md)
- [PreviewOrderResponse](docs/Model/PreviewOrderResponse.md)
- [PullingInterval](docs/Model/PullingInterval.md)
- [QuotesResponse](docs/Model/QuotesResponse.md)
- [QuotesResponseD](docs/Model/QuotesResponseD.md)
- [SetLeverage](docs/Model/SetLeverage.md)
- [SetLeverageResponse](docs/Model/SetLeverageResponse.md)
- [SingleField](docs/Model/SingleField.md)
- [SingleMapping](docs/Model/SingleMapping.md)
- [SingleQuote](docs/Model/SingleQuote.md)
- [Status](docs/Model/Status.md)
- [StopLossPercentValidationRule](docs/Model/StopLossPercentValidationRule.md)
- [StopLossPercentValidationRuleOptions](docs/Model/StopLossPercentValidationRuleOptions.md)
- [StopPercentValidationRule](docs/Model/StopPercentValidationRule.md)
- [StopPercentValidationRuleOptions](docs/Model/StopPercentValidationRuleOptions.md)
- [StreamingAskBidTradeItem](docs/Model/StreamingAskBidTradeItem.md)
- [StreamingAskItemType](docs/Model/StreamingAskItemType.md)
- [StreamingAskResponseDeprecated](docs/Model/StreamingAskResponseDeprecated.md)
- [StreamingBidItemType](docs/Model/StreamingBidItemType.md)
- [StreamingBidResponseDeprecated](docs/Model/StreamingBidResponseDeprecated.md)
- [StreamingDailyBarResponse](docs/Model/StreamingDailyBarResponse.md)
- [StreamingDailyBarResponseAllOf](docs/Model/StreamingDailyBarResponseAllOf.md)
- [StreamingDailyBarType](docs/Model/StreamingDailyBarType.md)
- [StreamingQuoteResponse](docs/Model/StreamingQuoteResponse.md)
- [StreamingTradeItemType](docs/Model/StreamingTradeItemType.md)
- [StreamingTradeResponse](docs/Model/StreamingTradeResponse.md)
- [SuccessResponse](docs/Model/SuccessResponse.md)
- [SymbolInfoArrays](docs/Model/SymbolInfoArrays.md)
- [SymbolInfoResponse](docs/Model/SymbolInfoResponse.md)
- [SymbolMapping](docs/Model/SymbolMapping.md)
- [SymbolType](docs/Model/SymbolType.md)
- [TakeProfitPercentValidationRule](docs/Model/TakeProfitPercentValidationRule.md)
- [TakeProfitPercentValidationRuleOptions](docs/Model/TakeProfitPercentValidationRuleOptions.md)

## Authorization

### OAuth2Bearer

- **Type**: `OAuth`
- **Flow**: `implicit`
- **Authorization URL**: `https://your-rest-implementation.com/api/authorize`
- **Scopes**: 
    - **general**: permission to perform all requests


### OAuth2Bearer

- **Type**: `OAuth`
- **Flow**: `accessCode`
- **Authorization URL**: `https://your-rest-implementation.com/api/authorize`
- **Scopes**: 
    - **general**: permission to perform all requests


### PasswordBearer

- **Type**: Bearer authentication (Bearer ACCESS_TOKEN)


### ServerOAuth2Bearer

- **Type**: `OAuth`
- **Flow**: `application`
- **Authorization URL**: ``
- **Scopes**: 
    - **general**: permission to perform all requests

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.3.27`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
