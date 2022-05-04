# # AccountState

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**balance** | **float** | Account Balance. |
**unrealized_pl** | **float** | Unrealized profit/loss. |
**equity** | **float** | Equity. If this field is not specified, then it is calculated as balance + unrealizedPl. | [optional]
**am_data** | **string[][][]** | Account manager data. Structure of Account manager is defined by the [/config](#operation/getConfiguration) endpoint. Each element of this array is a table. | [optional]
**account_summary_row_data** | **string[]** | Account Summary Row data. Structure of Account Summary Row is defined by the [/config](#operation/getConfiguration) endpoint. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
