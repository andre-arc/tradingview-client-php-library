# # Position

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Unique identifier. |
**instrument** | **string** | Instrument name that is used on a broker&#39;s side. |
**qty** | **float** | Quantity. |
**side** | **string** | Side. |
**avg_price** | **float** | Average price of position trades. |
**unrealized_pl** | **float** | Unrealized (open) profit/loss. | [optional]
**message** | [**\OpenAPI\Client\Model\Message**](Message.md) |  | [optional]
**custom_fields** | [**\OpenAPI\Client\Model\CustomFieldsValueItem[]**](CustomFieldsValueItem.md) | Localized position custom fields values data. Custom fields are configured in the [/config](#operation/getConfiguration) endpoint response. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
