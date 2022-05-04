# # Order

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Unique identifier. |
**instrument** | **string** | Instrument name that is used on a broker&#39;s side. |
**qty** | **float** | Quantity. |
**side** | **string** | Side. |
**type** | **string** | Type. |
**filled_qty** | **float** | Filled quantity. | [optional]
**avg_price** | **float** | Average price of order fills. It should be provided for filled / partly filled orders. | [optional]
**limit_price** | **float** | Limit Price for Limit or StopLimit order. | [optional]
**stop_price** | **float** | Stop Price for Stop or StopLimit order. | [optional]
**trailing_stop_pips** | **float** | Distance from the stop loss level to the current market price in pips for a position or to the order price if the parent is a stop or limit order. | [optional]
**is_trailing_stop** | **bool** | If this flag is set to &#x60;true&#x60;, then the stop order is a trailing stop. | [optional]
**parent_id** | **string** | Identifier of a parent order or a parent position (for position brackets) depending on &#x60;parentType&#x60;. Should be set only for bracket orders. | [optional]
**parent_type** | **string** | Type of order&#39;s parent. Should be set only for bracket orders. | [optional]
**duration** | [**\OpenAPI\Client\Model\OrderCommonDuration**](OrderCommonDuration.md) |  | [optional]
**last_modified** | **float** | Indicates the time when the order was last modified, Unix timestamp (UTC). | [optional]
**custom_fields** | [**\OpenAPI\Client\Model\CustomFieldsValueItem[]**](CustomFieldsValueItem.md) | Localized order custom fields values data. Custom fields are configured in the [/config](#operation/getConfiguration) endpoint response. Custom &#x60;Order dialog&#x60; fields are to be sent along with the standard fields in the order object. | [optional]
**message** | [**\OpenAPI\Client\Model\Message**](Message.md) |  | [optional]
**status** | **string** | String constants to describe an order status.  &#x60;Status&#x60;  | Description ----------|------------- placing   | order is not created on a broker&#39;s side yet inactive  | bracket order is created but waiting for a base order to be filled working   | order is created but not fully executed yet rejected  | order is rejected for some reason filled    | order is fully executed cancelled  | order is cancelled |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
