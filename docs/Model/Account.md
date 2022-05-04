# # Account

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Unique account identifier. |
**name** | **string** | Account title that is displayed to a user. |
**type** | **string** | Account type |
**currency** | **string** | Abbreviation of account currency. | [optional]
**currency_sign** | **string** | Account currency symbol. | [optional]
**config** | [**\OpenAPI\Client\Model\AccountFlags**](AccountFlags.md) |  |
**ui** | [**\OpenAPI\Client\Model\AccountUi**](AccountUi.md) |  | [optional]
**durations** | [**\OpenAPI\Client\Model\Duration[]**](Duration.md) | Localized array of durations displayed in Order Ticket. It will override values, specified in the [/config](#operation/getConfiguration) endpoint. | [optional]
**prefix** | **string** | Prefix for instruments. | [optional]
**is_verified** | **bool** | Used to confirm that the account has been verified (for example, KYC is passed). Only verified account users can leave reviews in the broker profile. | [optional] [default to false]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
