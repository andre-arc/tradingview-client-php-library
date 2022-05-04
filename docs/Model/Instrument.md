# # Instrument

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Broker instrument name. |
**description** | **string** | Instrument description. |
**min_qty** | **float** | Minimum quantity for trading. If &#x60;lotSize&#x60; is set, then the specified value must be in lots. | [optional]
**max_qty** | **float** | Maximum quantity for trading. If &#x60;lotSize&#x60; is set, then the specified value must be in lots. | [optional]
**qty_step** | **float** | Quantity step. If &#x60;lotSize&#x60; is set, then the specified value must be in lots. | [optional]
**pip_size** | **float** | Size of 1 pip. It is equal to &#x60;minTick&#x60; for non-forex symbols. For forex pairs it equals either the &#x60;minTick&#x60;, or the &#x60;minTick&#x60; multiplied by &#x60;10&#x60;. For example, for IBM &#x60;minTick&#x60; it is 0.01, for EURCAD &#x60;minTick&#x60; it is 0.00001. |
**pip_value** | **float** | Value of 1 pip in the account currency. |
**min_tick** | **float** | Minimum price movement. For example, for IBM &#x60;minTick&#x60; is 0.01, for EURCAD &#x60;minTick&#x60; is 0.00001. |
**lot_size** | **float** | Financial instrument units standardized number as set by the exchange or broker for buying or selling. | [optional]
**base_currency** | **string** | The first currency quoted in a currency pair. Used for crypto currencies only. | [optional]
**quote_currency** | **string** | A quote currency is the second currency quoted in a currency pair. Used for crypto currencies only. | [optional]
**margin_rate** | **float** | Margin rate for this instrument. | [optional]
**has_quotes** | **bool** | Indicates if your API provides quotes for this instrument. Assigning &#x60;false&#x60; to this field prevents &#x60;/quotes&#x60; request and makes ask/bid displayed from a TradingView server depending on users data subscriptions on TradingView. Use of this flag must be agreed with TradingView | [optional] [default to true]
**units** | **string** | Units of quantity or amount. Displayed instead of the &#x60;Units&#x60; label in the Quantity/Amount field | [optional]
**type** | [**\OpenAPI\Client\Model\SymbolType**](SymbolType.md) |  |
**ui** | [**\OpenAPI\Client\Model\InstrumentUi**](InstrumentUi.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
