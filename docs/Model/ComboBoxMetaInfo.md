# # ComboBoxMetaInfo

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Unique field identifier. |
**title** | **string** | Localized field display name. |
**save_to_settings** | **bool** | Whether the value should be stored in the user settings and preserved for the next time the dialog is displayed. | [optional] [default to false]
**mutable** | **bool** | Whether the integration supports modifying of this field. | [optional] [default to true]
**force_user_enter_initial_value** | **bool** | If this flag is set to true, the user will not be able to place an order without explicitly entering a value, so instant order placement is not available. | [optional] [default to false]
**items** | [**\OpenAPI\Client\Model\ComboBoxValue[]**](ComboBoxValue.md) |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
