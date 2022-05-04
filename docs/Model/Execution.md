# # Execution

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Unique identifier. |
**instrument** | **string** | Instrument id. |
**price** | **float** | Execution price. |
**time** | **float** | Execution time, Unix timestamp (UTC). |
**qty** | **float** | Execution quantity. |
**side** | **string** | Side. |
**order_id** | **string** | Identifier of the order that has been filled. |
**is_close** | **bool** | Whether the execution reduces the position. |
**position_id** | **string** | Identifier of the position that has been opened, modified or closed. | [optional]
**commission** | **float** | Commission charged for the fill. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
