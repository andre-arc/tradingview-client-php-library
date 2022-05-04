# # Duration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Duration identifier. |
**title** | **string** | Localized title. |
**has_date_picker** | **bool** | Display date control in Order Ticket for this duration type. | [optional] [default to false]
**has_time_picker** | **bool** | Display time control in Order Ticket for this duration type. | [optional] [default to false]
**default** | **bool** | Default duration. Only one duration object in the durations array can have a &#x60;true&#x60; value for this field. The default duration will be used when the user places orders in the silent mode and it will be the selected one when the user opens the Order dialog for the first time. | [optional] [default to false]
**supported_order_types** | **string[]** | An optional array of order types to which the duration will be applied. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
