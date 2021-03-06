# # AccountFlags

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**support_brackets** | **bool** | Whether the integration supports brackets. Deprecated. Use supportOrderBrackets and supportPositionBrackets instead. | [optional]
**support_order_brackets** | **bool** | Whether the integration supports brackets (take profit and stop loss) for orders. | [optional] [default to false]
**support_market_brackets** | **bool** | Whether the integration supports brackets for market orders. | [optional] [default to true]
**support_position_brackets** | **bool** | Whether the integration supports adding (or modifying) stop loss and take profit to positions. | [optional] [default to false]
**support_positions** | **bool** | Whether the integration supports the Positions tab. If you set it to &#x60;false&#x60;, the &#x60;/positions&#x60; endpoint will not be used. | [optional] [default to true]
**support_multiposition** | **bool** | Whether the integration supports multiple positions at one instrument at the same time. | [optional] [default to false]
**support_close_position** | **bool** | Whether the integration supports closing of a position without a need for a user to fill an order. | [optional] [default to false]
**support_partial_close_position** | **bool** | Whether the integration supports partial closing of a position. | [optional] [default to false]
**support_reverse_position** | **bool** | Whether the integration supports reversing of a position. If this flag is set to &#x60;false&#x60; the reverse position button will be hidden. | [optional] [default to true]
**support_native_reverse_position** | **bool** | Whether the integration natively supports reversing of a position. If it is natively supported then TradingView will send a request to the [Modify Position endpoint](#operation/modifyPosition) with the &#x60;side&#x60; parameter set. If it is not natively supported then a reversing order will be placed. | [optional] [default to false]
**support_market_orders** | **bool** | Whether the integration supports market orders. | [optional] [default to true]
**support_limit_orders** | **bool** | Whether the integration supports limit orders. | [optional] [default to true]
**support_stop_orders** | **bool** | Whether the integration supports stop orders. | [optional] [default to true]
**support_stop_limit_orders** | **bool** | Whether the integration supports StopLimit orders. | [optional] [default to false]
**support_trailing_stop** | **bool** | Whether the integration supports trailing stop orders. | [optional] [default to false]
**support_stop_orders_in_both_directions** | **bool** | Whether stop orders should behave like Market-if-touched in both directions. Enabling this flag removes the direction check from the order dialog. | [optional] [default to false]
**support_partial_order_execution** | **bool** | Whether the integration supports partial order&#39;s execution. If this flag is set to &#x60;true&#x60;, then the &#39;Filled Qty&#39; column will be displayed on the Orders tab. | [optional] [default to false]
**support_modify_order** | **bool** | Whether the integration supports the modification of the existing order. Deprecated. Use supportModifyOrderPrice, supportEditAmount and supportModifyBrackets instead. | [optional]
**support_modify_order_price** | **bool** | Whether the integration supports order price editing. If you set it to &#x60;false&#x60;, the price control in the order ticket will be disabled when modifying an order. | [optional] [default to true]
**support_edit_amount** | **bool** | Whether the integration supports editing orders quantity. If you set it to &#x60;false&#x60;, the quantity control in the order ticket will be disabled when modifying an order. | [optional] [default to true]
**support_modify_brackets** | **bool** | Whether the integration supports order brackets editing. If you set it to &#x60;false&#x60;, the bracket&#39;s control in the order ticket will be disabled when modifying an order, and &#39;Modify&#39; button will be hidden on a chart and in the Account Manager. | [optional] [default to true]
**support_modify_duration** | **bool** | Whether the integration supports the modification of the duration of the existing order. | [optional] [default to false]
**support_crypto_exchange_order_ticket** | **bool** | Whether the account is used to exchange(trade) crypto currencies. This flag switches the Order Ticket to the Crypto Exchange mode. It adds second currency quantity control, currency labels etc. | [optional] [default to false]
**support_digital_signature** | **bool** | Whether the integration supports Digital signature input field in the Order Ticket. | [optional] [default to false]
**support_place_order_preview** | **bool** | Whether the integration supports providing and displaying information (such as commission, margin, value, etc.) about the order being placed before submitting it. | [optional] [default to false]
**support_modify_order_preview** | **bool** | Whether the integration supports providing and displaying information (such as commission, margin, value, etc.) about the order being modified before submitting it. | [optional] [default to false]
**show_quantity_instead_of_amount** | **bool** | Renames Amount to Quantity in the Order Ticket. | [optional] [default to false]
**support_balances** | **bool** | Whether the integration supports [/balances](/rest-api-spec/#operation/getBalances) request. | [optional] [default to false]
**support_orders_history** | **bool** | Whether the integration supports [/ordersHistory](/rest-api-spec/#operation/getOrdersHistory) request. | [optional] [default to false]
**support_executions** | **bool** | Whether the integration supports [/executions](/rest-api-spec/#operation/getExecutions) request. | [optional] [default to false]
**support_leverage** | **bool** | Whether the integration supports leverage. If the flag is set to &#x60;true&#x60;, a leverage input field will appear in the Order Widget. Click on the input field will activate a dedicated Leverage Dialog. | [optional] [default to false]
**support_dom** | **bool** | Whether the integration supports DOM (Depth of market) widget to be available. | [optional] [default to true]
**support_level2_data** | **bool** | Whether the integration supports Level 2 data. It is required to display DOM levels. You must implement [/depth](/rest-api-spec/#operation/getDepth) endpoint to display DOM. | [optional] [default to false]
**support_pl_update** | **bool** | Whether the integration provide &#x60;unrealizedPl&#x60; for positions. Otherwise P&amp;L will be calculated automatically based on a simple algorithm. | [optional] [default to true]
**support_display_broker_name_in_symbol_search** | **bool** | Whether the integration involves displaying broker instrument names in the Symbol Search. You may usually want to disable it if broker symbols are the same or you are using internal numbers as broker symbol names. | [optional] [default to true]
**support_logout** | **bool** | Whether the integration supports logout. | [optional] [default to false]
**support_custom_account_summary_row** | **bool** | Whether the integration supports custom Account Summary Row. | [optional] [default to false]
**support_position_custom_fields** | **bool** | Whether the integration supports custom fields for position. | [optional] [default to false]
**support_order_custom_fields** | **bool** | Whether the integration supports custom fields for order. | [optional] [default to false]
**support_order_history_custom_fields** | **bool** | Whether the integration supports custom fields for order history. | [optional] [default to false]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
