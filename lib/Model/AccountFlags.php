<?php
/**
 * AccountFlags
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * TradingView REST API Specification for Brokers
 *
 * ## Overview   This API is to be implemented by the Brokers in order to connect their backend systems to TradingView, that acts as a frontend.    Check the [info page](https://www.tradingview.com/brokerage-integration/) for more info and use the contact form there if you have any questions.    ### Types of requests   There are two types of requests — client and server.   Client requests are executed at the browser. Server requests are initiated from the TradingView servers.   If your integration does not imply brokerage data stream connection to the TradingView website -   then there won't be any server requests.    #### Clients requests   From the browser TradingView requests the info (list of orders and positions, balance info, etc.) from the broker’s server.   The requests are sent periodically and the intervals can be set by using the [/config](#operation/getConfiguration) endpoint.   After that, TradingView compares the new data with the previous answer and calculates the difference.   If the status of the order/position changes or new data appears - the user will see a notification and the changes   will display in the Account manager on the website.    Requests to the [endpoints](/rest-api-spec/#tag/Trading) for placing/modifying orders, positions closing, etc. occur only after actions made by the user.    The [/quotes](#operation/getQuotes) endpoint retrieves the current bid/ask from the broker.   The [/depth](#operation/getDepth) endpoint retrieves Level 2 market data.    #### Server requests   In case if a Broker provides any Forex or CFD trading access for its clients it will require connection   of its own market data at TradingView. In order to make it possible, you will need to implement the following endpoints -     [/symbol_info](#operation/getSymbolInfo), [/history](#operation/getHistory) and [/streaming](#operation/streaming).   Data requests are sent from different TradingView servers. Usually, at least 4 servers are used.   The historical data is cached on TradingView servers and loaded to the client browser from our servers.    ### Restricting access to data   By default, the broker symbols will be available in the symbol search at TradingView and all the community   will have access to your data streams without any limitation. In order to limit the access to your data streams   please use the following endpoints - [/groups](#operation/getGroups) and [/permissions](#operation/getPermissions).    You can find more information about restricting access to the data in the description of these endpoints.    ### Change log   1.3.27. Added `hardToBorrow`, `notShortable`, `halted` parameters to the [/quotes](#operation/getQuotes) endpoint.    1.3.26. In [/symbol_info](#operation/getSymbolInfo), the `minmov2` property renamed to `minmovement2`, the `Etc/UTC`     timezone added. In [/history ](#operation/getHistory), the `HistoryNextBarResponse` response changed to     `HistoryEmptyBarResponse`, the `countback` query parameter became deprecated.     In [/accounts](#operation/getAccounts), added the `isVerified` property.    1.3.25. Added `locale` parameter to the [/authorize](#operation/authorize) endpoint.    1.3.24. Added leverage support. Added new `supportLeverage` flag. Added three new endpoints:     [/getLeverage](#operation/getLeverage), [/setLeverage](#operation/setLeverage) and [/previewLeverage](#operation/previewLeverage).    1.3.23. Changed description of `forceUserEnterInitialValue` flag in the `OrderDialogCustomFields` parameters.    1.3.22. Added new flags - `supportModifyOrderPrice` and `supportModifyBrackets`. The `supportModifyOrder` flag became deprecated.    1.3.21. Added new `units` field to the [/instruments](#operation/getInstruments) endpoint.    1.3.20. Added new `supportTrailingStop` flag. Added support for trailing stops for orders and positions.    1.3.19. Added new `logout` endpoint, `supportLogout` flag.    1.3.18. Added new `supportPartialClosePosition` flag and `amount` field to the [/closePosition](#operation/closePosition)     endpoint parameters.    1.3.17. Added `stopPercent` and `limitPercent` validation rules to the [/instruments](#operation/getInstruments) endpoint.    1.3.16. Added new `supportOrderHistoryCustomFields` flag and `orderHistoryCustomFields` field to the `ui` object     in the [/accounts](#operation/getAccounts) endpoint and [/config](#operation/getConfiguration).    1.3.15. Added `supportedOrderTypes` field to the `Duration` parameters.    1.3.14. Added `isCapitalize` field to the `positionCustomFields` and `orderCustomFields` parameters.    1.3.13. Added rules parameter to the [/instruments](#operation/getInstruments) endpoint.    1.3.12. Added `prefix` field to the `Account` parameters.    1.3.11. Changed description for [/placeOrder](#operation/placeOrder), [/modifyOrder](#operation/modifyOrder),     [/previewOrder](#operation/previewOrder), `OrderDialogCustomFields` and `customFields` field in `OrderCommon`.    1.3.10. Added `locale` query parameter to [/getOrders](#operation/getOrders), [/placeOrder](#operation/placeOrder),     [/modifyOrder](#operation/modifyOrder), [/cancelOrder](#operation/cancelOrder), [/getPositions](#operation/getPositions),     [/modifyPosition](#operation/modifyPosition), [/closePosition](#operation/closePosition),     [/getExecutions](#operation/getExecutions), [/getOrdersHistory](#operation/getOrdersHistory),     [/getQuotes](#operation/getQuotes), [/getDepth](#operation/getDepth) and [/getBalances](#operation/getBalances) endpoints.    1.3.9. Added `orderId`, `isClose`, `positionId` and `commission` fields to Execution.    1.3.8. Added `id` field to the [/previewOrder](#operation/previewOrder) endpoint parameters.    1.3.7. Added `mutable` field to the `OrderDialogCustomFields` parameters.    1.3.6. Added `lang` query parameter to OAuth authorization request.    1.3.5. Added `accountId` query parameter to `depth` endpoint.    1.3.4. Added Order dialog customization opportunity on the instrument basis. Moved `OrderDialogCustomFields` to     the `ui` object in the [/accounts](#operation/getAccounts) endpoint.    1.3.3. Added new `supportStopOrdersInBothDirections` flag.    1.3.2. Added new `previewOrder` endpoint, `supportPlaceOrderPreview` and `supportModifyOrderPreview ` flags.    1.3.1. Added OAuth 2 Code Flow.    1.3.0. Added overriding Account manager and Durations configuration on Account basis.    1.2.5. Added `reserved`, `value` and `valueCurrency` fields to Crypto Balances.    1.2.4. Added default values to the account flags. Added `supportMarketBrackets` account flag.    1.2.3. Added current ask/bid fields to the parameters of the order [placement](#operation/placeOrder)   and [modification](#operation/modifyPosition) requests.    1.2.2. Added supportPartialOrderExecution flag.    1.2.1. Added support for position's and order's Custom fields. Removed `fixedWidth` and `sortable` fields from `AccountManagerColumn`.    1.2.0. Introducing new Quote response. Deprecation of streaming Bid and Ask responses.   All new integrations should use the Quote response to provide ask/bid values.   Added supportMarketOrders, supportLimitOrders, supportStop orders account flags.   Added informational message to order and position.    1.1.3. Added support for reverse of the position.    1.1.2. Added support for custom Account Summary Row.    1.1.1. Added `type` field to [/accounts](#operation/getAccounts) endpoint.    1.1.0. Refactor, added examples.
 *
 * The version of the OpenAPI document: 1.3.27
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * AccountFlags Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class AccountFlags implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'AccountFlags';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'support_brackets' => 'bool',
        'support_order_brackets' => 'bool',
        'support_market_brackets' => 'bool',
        'support_position_brackets' => 'bool',
        'support_positions' => 'bool',
        'support_multiposition' => 'bool',
        'support_close_position' => 'bool',
        'support_partial_close_position' => 'bool',
        'support_reverse_position' => 'bool',
        'support_native_reverse_position' => 'bool',
        'support_market_orders' => 'bool',
        'support_limit_orders' => 'bool',
        'support_stop_orders' => 'bool',
        'support_stop_limit_orders' => 'bool',
        'support_trailing_stop' => 'bool',
        'support_stop_orders_in_both_directions' => 'bool',
        'support_partial_order_execution' => 'bool',
        'support_modify_order' => 'bool',
        'support_modify_order_price' => 'bool',
        'support_edit_amount' => 'bool',
        'support_modify_brackets' => 'bool',
        'support_modify_duration' => 'bool',
        'support_crypto_exchange_order_ticket' => 'bool',
        'support_digital_signature' => 'bool',
        'support_place_order_preview' => 'bool',
        'support_modify_order_preview' => 'bool',
        'show_quantity_instead_of_amount' => 'bool',
        'support_balances' => 'bool',
        'support_orders_history' => 'bool',
        'support_executions' => 'bool',
        'support_leverage' => 'bool',
        'support_dom' => 'bool',
        'support_level2_data' => 'bool',
        'support_pl_update' => 'bool',
        'support_display_broker_name_in_symbol_search' => 'bool',
        'support_logout' => 'bool',
        'support_custom_account_summary_row' => 'bool',
        'support_position_custom_fields' => 'bool',
        'support_order_custom_fields' => 'bool',
        'support_order_history_custom_fields' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'support_brackets' => null,
        'support_order_brackets' => null,
        'support_market_brackets' => null,
        'support_position_brackets' => null,
        'support_positions' => null,
        'support_multiposition' => null,
        'support_close_position' => null,
        'support_partial_close_position' => null,
        'support_reverse_position' => null,
        'support_native_reverse_position' => null,
        'support_market_orders' => null,
        'support_limit_orders' => null,
        'support_stop_orders' => null,
        'support_stop_limit_orders' => null,
        'support_trailing_stop' => null,
        'support_stop_orders_in_both_directions' => null,
        'support_partial_order_execution' => null,
        'support_modify_order' => null,
        'support_modify_order_price' => null,
        'support_edit_amount' => null,
        'support_modify_brackets' => null,
        'support_modify_duration' => null,
        'support_crypto_exchange_order_ticket' => null,
        'support_digital_signature' => null,
        'support_place_order_preview' => null,
        'support_modify_order_preview' => null,
        'show_quantity_instead_of_amount' => null,
        'support_balances' => null,
        'support_orders_history' => null,
        'support_executions' => null,
        'support_leverage' => null,
        'support_dom' => null,
        'support_level2_data' => null,
        'support_pl_update' => null,
        'support_display_broker_name_in_symbol_search' => null,
        'support_logout' => null,
        'support_custom_account_summary_row' => null,
        'support_position_custom_fields' => null,
        'support_order_custom_fields' => null,
        'support_order_history_custom_fields' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'support_brackets' => 'supportBrackets',
        'support_order_brackets' => 'supportOrderBrackets',
        'support_market_brackets' => 'supportMarketBrackets',
        'support_position_brackets' => 'supportPositionBrackets',
        'support_positions' => 'supportPositions',
        'support_multiposition' => 'supportMultiposition',
        'support_close_position' => 'supportClosePosition',
        'support_partial_close_position' => 'supportPartialClosePosition',
        'support_reverse_position' => 'supportReversePosition',
        'support_native_reverse_position' => 'supportNativeReversePosition',
        'support_market_orders' => 'supportMarketOrders',
        'support_limit_orders' => 'supportLimitOrders',
        'support_stop_orders' => 'supportStopOrders',
        'support_stop_limit_orders' => 'supportStopLimitOrders',
        'support_trailing_stop' => 'supportTrailingStop',
        'support_stop_orders_in_both_directions' => 'supportStopOrdersInBothDirections',
        'support_partial_order_execution' => 'supportPartialOrderExecution',
        'support_modify_order' => 'supportModifyOrder',
        'support_modify_order_price' => 'supportModifyOrderPrice',
        'support_edit_amount' => 'supportEditAmount',
        'support_modify_brackets' => 'supportModifyBrackets',
        'support_modify_duration' => 'supportModifyDuration',
        'support_crypto_exchange_order_ticket' => 'supportCryptoExchangeOrderTicket',
        'support_digital_signature' => 'supportDigitalSignature',
        'support_place_order_preview' => 'supportPlaceOrderPreview',
        'support_modify_order_preview' => 'supportModifyOrderPreview',
        'show_quantity_instead_of_amount' => 'showQuantityInsteadOfAmount',
        'support_balances' => 'supportBalances',
        'support_orders_history' => 'supportOrdersHistory',
        'support_executions' => 'supportExecutions',
        'support_leverage' => 'supportLeverage',
        'support_dom' => 'supportDOM',
        'support_level2_data' => 'supportLevel2Data',
        'support_pl_update' => 'supportPLUpdate',
        'support_display_broker_name_in_symbol_search' => 'supportDisplayBrokerNameInSymbolSearch',
        'support_logout' => 'supportLogout',
        'support_custom_account_summary_row' => 'supportCustomAccountSummaryRow',
        'support_position_custom_fields' => 'supportPositionCustomFields',
        'support_order_custom_fields' => 'supportOrderCustomFields',
        'support_order_history_custom_fields' => 'supportOrderHistoryCustomFields'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'support_brackets' => 'setSupportBrackets',
        'support_order_brackets' => 'setSupportOrderBrackets',
        'support_market_brackets' => 'setSupportMarketBrackets',
        'support_position_brackets' => 'setSupportPositionBrackets',
        'support_positions' => 'setSupportPositions',
        'support_multiposition' => 'setSupportMultiposition',
        'support_close_position' => 'setSupportClosePosition',
        'support_partial_close_position' => 'setSupportPartialClosePosition',
        'support_reverse_position' => 'setSupportReversePosition',
        'support_native_reverse_position' => 'setSupportNativeReversePosition',
        'support_market_orders' => 'setSupportMarketOrders',
        'support_limit_orders' => 'setSupportLimitOrders',
        'support_stop_orders' => 'setSupportStopOrders',
        'support_stop_limit_orders' => 'setSupportStopLimitOrders',
        'support_trailing_stop' => 'setSupportTrailingStop',
        'support_stop_orders_in_both_directions' => 'setSupportStopOrdersInBothDirections',
        'support_partial_order_execution' => 'setSupportPartialOrderExecution',
        'support_modify_order' => 'setSupportModifyOrder',
        'support_modify_order_price' => 'setSupportModifyOrderPrice',
        'support_edit_amount' => 'setSupportEditAmount',
        'support_modify_brackets' => 'setSupportModifyBrackets',
        'support_modify_duration' => 'setSupportModifyDuration',
        'support_crypto_exchange_order_ticket' => 'setSupportCryptoExchangeOrderTicket',
        'support_digital_signature' => 'setSupportDigitalSignature',
        'support_place_order_preview' => 'setSupportPlaceOrderPreview',
        'support_modify_order_preview' => 'setSupportModifyOrderPreview',
        'show_quantity_instead_of_amount' => 'setShowQuantityInsteadOfAmount',
        'support_balances' => 'setSupportBalances',
        'support_orders_history' => 'setSupportOrdersHistory',
        'support_executions' => 'setSupportExecutions',
        'support_leverage' => 'setSupportLeverage',
        'support_dom' => 'setSupportDom',
        'support_level2_data' => 'setSupportLevel2Data',
        'support_pl_update' => 'setSupportPlUpdate',
        'support_display_broker_name_in_symbol_search' => 'setSupportDisplayBrokerNameInSymbolSearch',
        'support_logout' => 'setSupportLogout',
        'support_custom_account_summary_row' => 'setSupportCustomAccountSummaryRow',
        'support_position_custom_fields' => 'setSupportPositionCustomFields',
        'support_order_custom_fields' => 'setSupportOrderCustomFields',
        'support_order_history_custom_fields' => 'setSupportOrderHistoryCustomFields'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'support_brackets' => 'getSupportBrackets',
        'support_order_brackets' => 'getSupportOrderBrackets',
        'support_market_brackets' => 'getSupportMarketBrackets',
        'support_position_brackets' => 'getSupportPositionBrackets',
        'support_positions' => 'getSupportPositions',
        'support_multiposition' => 'getSupportMultiposition',
        'support_close_position' => 'getSupportClosePosition',
        'support_partial_close_position' => 'getSupportPartialClosePosition',
        'support_reverse_position' => 'getSupportReversePosition',
        'support_native_reverse_position' => 'getSupportNativeReversePosition',
        'support_market_orders' => 'getSupportMarketOrders',
        'support_limit_orders' => 'getSupportLimitOrders',
        'support_stop_orders' => 'getSupportStopOrders',
        'support_stop_limit_orders' => 'getSupportStopLimitOrders',
        'support_trailing_stop' => 'getSupportTrailingStop',
        'support_stop_orders_in_both_directions' => 'getSupportStopOrdersInBothDirections',
        'support_partial_order_execution' => 'getSupportPartialOrderExecution',
        'support_modify_order' => 'getSupportModifyOrder',
        'support_modify_order_price' => 'getSupportModifyOrderPrice',
        'support_edit_amount' => 'getSupportEditAmount',
        'support_modify_brackets' => 'getSupportModifyBrackets',
        'support_modify_duration' => 'getSupportModifyDuration',
        'support_crypto_exchange_order_ticket' => 'getSupportCryptoExchangeOrderTicket',
        'support_digital_signature' => 'getSupportDigitalSignature',
        'support_place_order_preview' => 'getSupportPlaceOrderPreview',
        'support_modify_order_preview' => 'getSupportModifyOrderPreview',
        'show_quantity_instead_of_amount' => 'getShowQuantityInsteadOfAmount',
        'support_balances' => 'getSupportBalances',
        'support_orders_history' => 'getSupportOrdersHistory',
        'support_executions' => 'getSupportExecutions',
        'support_leverage' => 'getSupportLeverage',
        'support_dom' => 'getSupportDom',
        'support_level2_data' => 'getSupportLevel2Data',
        'support_pl_update' => 'getSupportPlUpdate',
        'support_display_broker_name_in_symbol_search' => 'getSupportDisplayBrokerNameInSymbolSearch',
        'support_logout' => 'getSupportLogout',
        'support_custom_account_summary_row' => 'getSupportCustomAccountSummaryRow',
        'support_position_custom_fields' => 'getSupportPositionCustomFields',
        'support_order_custom_fields' => 'getSupportOrderCustomFields',
        'support_order_history_custom_fields' => 'getSupportOrderHistoryCustomFields'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['support_brackets'] = $data['support_brackets'] ?? null;
        $this->container['support_order_brackets'] = $data['support_order_brackets'] ?? false;
        $this->container['support_market_brackets'] = $data['support_market_brackets'] ?? true;
        $this->container['support_position_brackets'] = $data['support_position_brackets'] ?? false;
        $this->container['support_positions'] = $data['support_positions'] ?? true;
        $this->container['support_multiposition'] = $data['support_multiposition'] ?? false;
        $this->container['support_close_position'] = $data['support_close_position'] ?? false;
        $this->container['support_partial_close_position'] = $data['support_partial_close_position'] ?? false;
        $this->container['support_reverse_position'] = $data['support_reverse_position'] ?? true;
        $this->container['support_native_reverse_position'] = $data['support_native_reverse_position'] ?? false;
        $this->container['support_market_orders'] = $data['support_market_orders'] ?? true;
        $this->container['support_limit_orders'] = $data['support_limit_orders'] ?? true;
        $this->container['support_stop_orders'] = $data['support_stop_orders'] ?? true;
        $this->container['support_stop_limit_orders'] = $data['support_stop_limit_orders'] ?? false;
        $this->container['support_trailing_stop'] = $data['support_trailing_stop'] ?? false;
        $this->container['support_stop_orders_in_both_directions'] = $data['support_stop_orders_in_both_directions'] ?? false;
        $this->container['support_partial_order_execution'] = $data['support_partial_order_execution'] ?? false;
        $this->container['support_modify_order'] = $data['support_modify_order'] ?? null;
        $this->container['support_modify_order_price'] = $data['support_modify_order_price'] ?? true;
        $this->container['support_edit_amount'] = $data['support_edit_amount'] ?? true;
        $this->container['support_modify_brackets'] = $data['support_modify_brackets'] ?? true;
        $this->container['support_modify_duration'] = $data['support_modify_duration'] ?? false;
        $this->container['support_crypto_exchange_order_ticket'] = $data['support_crypto_exchange_order_ticket'] ?? false;
        $this->container['support_digital_signature'] = $data['support_digital_signature'] ?? false;
        $this->container['support_place_order_preview'] = $data['support_place_order_preview'] ?? false;
        $this->container['support_modify_order_preview'] = $data['support_modify_order_preview'] ?? false;
        $this->container['show_quantity_instead_of_amount'] = $data['show_quantity_instead_of_amount'] ?? false;
        $this->container['support_balances'] = $data['support_balances'] ?? false;
        $this->container['support_orders_history'] = $data['support_orders_history'] ?? false;
        $this->container['support_executions'] = $data['support_executions'] ?? false;
        $this->container['support_leverage'] = $data['support_leverage'] ?? false;
        $this->container['support_dom'] = $data['support_dom'] ?? true;
        $this->container['support_level2_data'] = $data['support_level2_data'] ?? false;
        $this->container['support_pl_update'] = $data['support_pl_update'] ?? true;
        $this->container['support_display_broker_name_in_symbol_search'] = $data['support_display_broker_name_in_symbol_search'] ?? true;
        $this->container['support_logout'] = $data['support_logout'] ?? false;
        $this->container['support_custom_account_summary_row'] = $data['support_custom_account_summary_row'] ?? false;
        $this->container['support_position_custom_fields'] = $data['support_position_custom_fields'] ?? false;
        $this->container['support_order_custom_fields'] = $data['support_order_custom_fields'] ?? false;
        $this->container['support_order_history_custom_fields'] = $data['support_order_history_custom_fields'] ?? false;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets support_brackets
     *
     * @return bool|null
     * @deprecated
     */
    public function getSupportBrackets()
    {
        return $this->container['support_brackets'];
    }

    /**
     * Sets support_brackets
     *
     * @param bool|null $support_brackets Whether the integration supports brackets. Deprecated. Use supportOrderBrackets and supportPositionBrackets instead.
     *
     * @return self
     * @deprecated
     */
    public function setSupportBrackets($support_brackets)
    {
        $this->container['support_brackets'] = $support_brackets;

        return $this;
    }

    /**
     * Gets support_order_brackets
     *
     * @return bool|null
     */
    public function getSupportOrderBrackets()
    {
        return $this->container['support_order_brackets'];
    }

    /**
     * Sets support_order_brackets
     *
     * @param bool|null $support_order_brackets Whether the integration supports brackets (take profit and stop loss) for orders.
     *
     * @return self
     */
    public function setSupportOrderBrackets($support_order_brackets)
    {
        $this->container['support_order_brackets'] = $support_order_brackets;

        return $this;
    }

    /**
     * Gets support_market_brackets
     *
     * @return bool|null
     */
    public function getSupportMarketBrackets()
    {
        return $this->container['support_market_brackets'];
    }

    /**
     * Sets support_market_brackets
     *
     * @param bool|null $support_market_brackets Whether the integration supports brackets for market orders.
     *
     * @return self
     */
    public function setSupportMarketBrackets($support_market_brackets)
    {
        $this->container['support_market_brackets'] = $support_market_brackets;

        return $this;
    }

    /**
     * Gets support_position_brackets
     *
     * @return bool|null
     */
    public function getSupportPositionBrackets()
    {
        return $this->container['support_position_brackets'];
    }

    /**
     * Sets support_position_brackets
     *
     * @param bool|null $support_position_brackets Whether the integration supports adding (or modifying) stop loss and take profit to positions.
     *
     * @return self
     */
    public function setSupportPositionBrackets($support_position_brackets)
    {
        $this->container['support_position_brackets'] = $support_position_brackets;

        return $this;
    }

    /**
     * Gets support_positions
     *
     * @return bool|null
     */
    public function getSupportPositions()
    {
        return $this->container['support_positions'];
    }

    /**
     * Sets support_positions
     *
     * @param bool|null $support_positions Whether the integration supports the Positions tab. If you set it to `false`, the `/positions` endpoint will not be used.
     *
     * @return self
     */
    public function setSupportPositions($support_positions)
    {
        $this->container['support_positions'] = $support_positions;

        return $this;
    }

    /**
     * Gets support_multiposition
     *
     * @return bool|null
     */
    public function getSupportMultiposition()
    {
        return $this->container['support_multiposition'];
    }

    /**
     * Sets support_multiposition
     *
     * @param bool|null $support_multiposition Whether the integration supports multiple positions at one instrument at the same time.
     *
     * @return self
     */
    public function setSupportMultiposition($support_multiposition)
    {
        $this->container['support_multiposition'] = $support_multiposition;

        return $this;
    }

    /**
     * Gets support_close_position
     *
     * @return bool|null
     */
    public function getSupportClosePosition()
    {
        return $this->container['support_close_position'];
    }

    /**
     * Sets support_close_position
     *
     * @param bool|null $support_close_position Whether the integration supports closing of a position without a need for a user to fill an order.
     *
     * @return self
     */
    public function setSupportClosePosition($support_close_position)
    {
        $this->container['support_close_position'] = $support_close_position;

        return $this;
    }

    /**
     * Gets support_partial_close_position
     *
     * @return bool|null
     */
    public function getSupportPartialClosePosition()
    {
        return $this->container['support_partial_close_position'];
    }

    /**
     * Sets support_partial_close_position
     *
     * @param bool|null $support_partial_close_position Whether the integration supports partial closing of a position.
     *
     * @return self
     */
    public function setSupportPartialClosePosition($support_partial_close_position)
    {
        $this->container['support_partial_close_position'] = $support_partial_close_position;

        return $this;
    }

    /**
     * Gets support_reverse_position
     *
     * @return bool|null
     */
    public function getSupportReversePosition()
    {
        return $this->container['support_reverse_position'];
    }

    /**
     * Sets support_reverse_position
     *
     * @param bool|null $support_reverse_position Whether the integration supports reversing of a position. If this flag is set to `false` the reverse position button will be hidden.
     *
     * @return self
     */
    public function setSupportReversePosition($support_reverse_position)
    {
        $this->container['support_reverse_position'] = $support_reverse_position;

        return $this;
    }

    /**
     * Gets support_native_reverse_position
     *
     * @return bool|null
     */
    public function getSupportNativeReversePosition()
    {
        return $this->container['support_native_reverse_position'];
    }

    /**
     * Sets support_native_reverse_position
     *
     * @param bool|null $support_native_reverse_position Whether the integration natively supports reversing of a position. If it is natively supported then TradingView will send a request to the [Modify Position endpoint](#operation/modifyPosition) with the `side` parameter set. If it is not natively supported then a reversing order will be placed.
     *
     * @return self
     */
    public function setSupportNativeReversePosition($support_native_reverse_position)
    {
        $this->container['support_native_reverse_position'] = $support_native_reverse_position;

        return $this;
    }

    /**
     * Gets support_market_orders
     *
     * @return bool|null
     */
    public function getSupportMarketOrders()
    {
        return $this->container['support_market_orders'];
    }

    /**
     * Sets support_market_orders
     *
     * @param bool|null $support_market_orders Whether the integration supports market orders.
     *
     * @return self
     */
    public function setSupportMarketOrders($support_market_orders)
    {
        $this->container['support_market_orders'] = $support_market_orders;

        return $this;
    }

    /**
     * Gets support_limit_orders
     *
     * @return bool|null
     */
    public function getSupportLimitOrders()
    {
        return $this->container['support_limit_orders'];
    }

    /**
     * Sets support_limit_orders
     *
     * @param bool|null $support_limit_orders Whether the integration supports limit orders.
     *
     * @return self
     */
    public function setSupportLimitOrders($support_limit_orders)
    {
        $this->container['support_limit_orders'] = $support_limit_orders;

        return $this;
    }

    /**
     * Gets support_stop_orders
     *
     * @return bool|null
     */
    public function getSupportStopOrders()
    {
        return $this->container['support_stop_orders'];
    }

    /**
     * Sets support_stop_orders
     *
     * @param bool|null $support_stop_orders Whether the integration supports stop orders.
     *
     * @return self
     */
    public function setSupportStopOrders($support_stop_orders)
    {
        $this->container['support_stop_orders'] = $support_stop_orders;

        return $this;
    }

    /**
     * Gets support_stop_limit_orders
     *
     * @return bool|null
     */
    public function getSupportStopLimitOrders()
    {
        return $this->container['support_stop_limit_orders'];
    }

    /**
     * Sets support_stop_limit_orders
     *
     * @param bool|null $support_stop_limit_orders Whether the integration supports StopLimit orders.
     *
     * @return self
     */
    public function setSupportStopLimitOrders($support_stop_limit_orders)
    {
        $this->container['support_stop_limit_orders'] = $support_stop_limit_orders;

        return $this;
    }

    /**
     * Gets support_trailing_stop
     *
     * @return bool|null
     */
    public function getSupportTrailingStop()
    {
        return $this->container['support_trailing_stop'];
    }

    /**
     * Sets support_trailing_stop
     *
     * @param bool|null $support_trailing_stop Whether the integration supports trailing stop orders.
     *
     * @return self
     */
    public function setSupportTrailingStop($support_trailing_stop)
    {
        $this->container['support_trailing_stop'] = $support_trailing_stop;

        return $this;
    }

    /**
     * Gets support_stop_orders_in_both_directions
     *
     * @return bool|null
     */
    public function getSupportStopOrdersInBothDirections()
    {
        return $this->container['support_stop_orders_in_both_directions'];
    }

    /**
     * Sets support_stop_orders_in_both_directions
     *
     * @param bool|null $support_stop_orders_in_both_directions Whether stop orders should behave like Market-if-touched in both directions. Enabling this flag removes the direction check from the order dialog.
     *
     * @return self
     */
    public function setSupportStopOrdersInBothDirections($support_stop_orders_in_both_directions)
    {
        $this->container['support_stop_orders_in_both_directions'] = $support_stop_orders_in_both_directions;

        return $this;
    }

    /**
     * Gets support_partial_order_execution
     *
     * @return bool|null
     */
    public function getSupportPartialOrderExecution()
    {
        return $this->container['support_partial_order_execution'];
    }

    /**
     * Sets support_partial_order_execution
     *
     * @param bool|null $support_partial_order_execution Whether the integration supports partial order's execution. If this flag is set to `true`, then the 'Filled Qty' column will be displayed on the Orders tab.
     *
     * @return self
     */
    public function setSupportPartialOrderExecution($support_partial_order_execution)
    {
        $this->container['support_partial_order_execution'] = $support_partial_order_execution;

        return $this;
    }

    /**
     * Gets support_modify_order
     *
     * @return bool|null
     * @deprecated
     */
    public function getSupportModifyOrder()
    {
        return $this->container['support_modify_order'];
    }

    /**
     * Sets support_modify_order
     *
     * @param bool|null $support_modify_order Whether the integration supports the modification of the existing order. Deprecated. Use supportModifyOrderPrice, supportEditAmount and supportModifyBrackets instead.
     *
     * @return self
     * @deprecated
     */
    public function setSupportModifyOrder($support_modify_order)
    {
        $this->container['support_modify_order'] = $support_modify_order;

        return $this;
    }

    /**
     * Gets support_modify_order_price
     *
     * @return bool|null
     */
    public function getSupportModifyOrderPrice()
    {
        return $this->container['support_modify_order_price'];
    }

    /**
     * Sets support_modify_order_price
     *
     * @param bool|null $support_modify_order_price Whether the integration supports order price editing. If you set it to `false`, the price control in the order ticket will be disabled when modifying an order.
     *
     * @return self
     */
    public function setSupportModifyOrderPrice($support_modify_order_price)
    {
        $this->container['support_modify_order_price'] = $support_modify_order_price;

        return $this;
    }

    /**
     * Gets support_edit_amount
     *
     * @return bool|null
     */
    public function getSupportEditAmount()
    {
        return $this->container['support_edit_amount'];
    }

    /**
     * Sets support_edit_amount
     *
     * @param bool|null $support_edit_amount Whether the integration supports editing orders quantity. If you set it to `false`, the quantity control in the order ticket will be disabled when modifying an order.
     *
     * @return self
     */
    public function setSupportEditAmount($support_edit_amount)
    {
        $this->container['support_edit_amount'] = $support_edit_amount;

        return $this;
    }

    /**
     * Gets support_modify_brackets
     *
     * @return bool|null
     */
    public function getSupportModifyBrackets()
    {
        return $this->container['support_modify_brackets'];
    }

    /**
     * Sets support_modify_brackets
     *
     * @param bool|null $support_modify_brackets Whether the integration supports order brackets editing. If you set it to `false`, the bracket's control in the order ticket will be disabled when modifying an order, and 'Modify' button will be hidden on a chart and in the Account Manager.
     *
     * @return self
     */
    public function setSupportModifyBrackets($support_modify_brackets)
    {
        $this->container['support_modify_brackets'] = $support_modify_brackets;

        return $this;
    }

    /**
     * Gets support_modify_duration
     *
     * @return bool|null
     */
    public function getSupportModifyDuration()
    {
        return $this->container['support_modify_duration'];
    }

    /**
     * Sets support_modify_duration
     *
     * @param bool|null $support_modify_duration Whether the integration supports the modification of the duration of the existing order.
     *
     * @return self
     */
    public function setSupportModifyDuration($support_modify_duration)
    {
        $this->container['support_modify_duration'] = $support_modify_duration;

        return $this;
    }

    /**
     * Gets support_crypto_exchange_order_ticket
     *
     * @return bool|null
     */
    public function getSupportCryptoExchangeOrderTicket()
    {
        return $this->container['support_crypto_exchange_order_ticket'];
    }

    /**
     * Sets support_crypto_exchange_order_ticket
     *
     * @param bool|null $support_crypto_exchange_order_ticket Whether the account is used to exchange(trade) crypto currencies. This flag switches the Order Ticket to the Crypto Exchange mode. It adds second currency quantity control, currency labels etc.
     *
     * @return self
     */
    public function setSupportCryptoExchangeOrderTicket($support_crypto_exchange_order_ticket)
    {
        $this->container['support_crypto_exchange_order_ticket'] = $support_crypto_exchange_order_ticket;

        return $this;
    }

    /**
     * Gets support_digital_signature
     *
     * @return bool|null
     */
    public function getSupportDigitalSignature()
    {
        return $this->container['support_digital_signature'];
    }

    /**
     * Sets support_digital_signature
     *
     * @param bool|null $support_digital_signature Whether the integration supports Digital signature input field in the Order Ticket.
     *
     * @return self
     */
    public function setSupportDigitalSignature($support_digital_signature)
    {
        $this->container['support_digital_signature'] = $support_digital_signature;

        return $this;
    }

    /**
     * Gets support_place_order_preview
     *
     * @return bool|null
     */
    public function getSupportPlaceOrderPreview()
    {
        return $this->container['support_place_order_preview'];
    }

    /**
     * Sets support_place_order_preview
     *
     * @param bool|null $support_place_order_preview Whether the integration supports providing and displaying information (such as commission, margin, value, etc.) about the order being placed before submitting it.
     *
     * @return self
     */
    public function setSupportPlaceOrderPreview($support_place_order_preview)
    {
        $this->container['support_place_order_preview'] = $support_place_order_preview;

        return $this;
    }

    /**
     * Gets support_modify_order_preview
     *
     * @return bool|null
     */
    public function getSupportModifyOrderPreview()
    {
        return $this->container['support_modify_order_preview'];
    }

    /**
     * Sets support_modify_order_preview
     *
     * @param bool|null $support_modify_order_preview Whether the integration supports providing and displaying information (such as commission, margin, value, etc.) about the order being modified before submitting it.
     *
     * @return self
     */
    public function setSupportModifyOrderPreview($support_modify_order_preview)
    {
        $this->container['support_modify_order_preview'] = $support_modify_order_preview;

        return $this;
    }

    /**
     * Gets show_quantity_instead_of_amount
     *
     * @return bool|null
     */
    public function getShowQuantityInsteadOfAmount()
    {
        return $this->container['show_quantity_instead_of_amount'];
    }

    /**
     * Sets show_quantity_instead_of_amount
     *
     * @param bool|null $show_quantity_instead_of_amount Renames Amount to Quantity in the Order Ticket.
     *
     * @return self
     */
    public function setShowQuantityInsteadOfAmount($show_quantity_instead_of_amount)
    {
        $this->container['show_quantity_instead_of_amount'] = $show_quantity_instead_of_amount;

        return $this;
    }

    /**
     * Gets support_balances
     *
     * @return bool|null
     */
    public function getSupportBalances()
    {
        return $this->container['support_balances'];
    }

    /**
     * Sets support_balances
     *
     * @param bool|null $support_balances Whether the integration supports [/balances](/rest-api-spec/#operation/getBalances) request.
     *
     * @return self
     */
    public function setSupportBalances($support_balances)
    {
        $this->container['support_balances'] = $support_balances;

        return $this;
    }

    /**
     * Gets support_orders_history
     *
     * @return bool|null
     */
    public function getSupportOrdersHistory()
    {
        return $this->container['support_orders_history'];
    }

    /**
     * Sets support_orders_history
     *
     * @param bool|null $support_orders_history Whether the integration supports [/ordersHistory](/rest-api-spec/#operation/getOrdersHistory) request.
     *
     * @return self
     */
    public function setSupportOrdersHistory($support_orders_history)
    {
        $this->container['support_orders_history'] = $support_orders_history;

        return $this;
    }

    /**
     * Gets support_executions
     *
     * @return bool|null
     */
    public function getSupportExecutions()
    {
        return $this->container['support_executions'];
    }

    /**
     * Sets support_executions
     *
     * @param bool|null $support_executions Whether the integration supports [/executions](/rest-api-spec/#operation/getExecutions) request.
     *
     * @return self
     */
    public function setSupportExecutions($support_executions)
    {
        $this->container['support_executions'] = $support_executions;

        return $this;
    }

    /**
     * Gets support_leverage
     *
     * @return bool|null
     */
    public function getSupportLeverage()
    {
        return $this->container['support_leverage'];
    }

    /**
     * Sets support_leverage
     *
     * @param bool|null $support_leverage Whether the integration supports leverage. If the flag is set to `true`, a leverage input field will appear in the Order Widget. Click on the input field will activate a dedicated Leverage Dialog.
     *
     * @return self
     */
    public function setSupportLeverage($support_leverage)
    {
        $this->container['support_leverage'] = $support_leverage;

        return $this;
    }

    /**
     * Gets support_dom
     *
     * @return bool|null
     */
    public function getSupportDom()
    {
        return $this->container['support_dom'];
    }

    /**
     * Sets support_dom
     *
     * @param bool|null $support_dom Whether the integration supports DOM (Depth of market) widget to be available.
     *
     * @return self
     */
    public function setSupportDom($support_dom)
    {
        $this->container['support_dom'] = $support_dom;

        return $this;
    }

    /**
     * Gets support_level2_data
     *
     * @return bool|null
     */
    public function getSupportLevel2Data()
    {
        return $this->container['support_level2_data'];
    }

    /**
     * Sets support_level2_data
     *
     * @param bool|null $support_level2_data Whether the integration supports Level 2 data. It is required to display DOM levels. You must implement [/depth](/rest-api-spec/#operation/getDepth) endpoint to display DOM.
     *
     * @return self
     */
    public function setSupportLevel2Data($support_level2_data)
    {
        $this->container['support_level2_data'] = $support_level2_data;

        return $this;
    }

    /**
     * Gets support_pl_update
     *
     * @return bool|null
     */
    public function getSupportPlUpdate()
    {
        return $this->container['support_pl_update'];
    }

    /**
     * Sets support_pl_update
     *
     * @param bool|null $support_pl_update Whether the integration provide `unrealizedPl` for positions. Otherwise P&L will be calculated automatically based on a simple algorithm.
     *
     * @return self
     */
    public function setSupportPlUpdate($support_pl_update)
    {
        $this->container['support_pl_update'] = $support_pl_update;

        return $this;
    }

    /**
     * Gets support_display_broker_name_in_symbol_search
     *
     * @return bool|null
     */
    public function getSupportDisplayBrokerNameInSymbolSearch()
    {
        return $this->container['support_display_broker_name_in_symbol_search'];
    }

    /**
     * Sets support_display_broker_name_in_symbol_search
     *
     * @param bool|null $support_display_broker_name_in_symbol_search Whether the integration involves displaying broker instrument names in the Symbol Search. You may usually want to disable it if broker symbols are the same or you are using internal numbers as broker symbol names.
     *
     * @return self
     */
    public function setSupportDisplayBrokerNameInSymbolSearch($support_display_broker_name_in_symbol_search)
    {
        $this->container['support_display_broker_name_in_symbol_search'] = $support_display_broker_name_in_symbol_search;

        return $this;
    }

    /**
     * Gets support_logout
     *
     * @return bool|null
     */
    public function getSupportLogout()
    {
        return $this->container['support_logout'];
    }

    /**
     * Sets support_logout
     *
     * @param bool|null $support_logout Whether the integration supports logout.
     *
     * @return self
     */
    public function setSupportLogout($support_logout)
    {
        $this->container['support_logout'] = $support_logout;

        return $this;
    }

    /**
     * Gets support_custom_account_summary_row
     *
     * @return bool|null
     */
    public function getSupportCustomAccountSummaryRow()
    {
        return $this->container['support_custom_account_summary_row'];
    }

    /**
     * Sets support_custom_account_summary_row
     *
     * @param bool|null $support_custom_account_summary_row Whether the integration supports custom Account Summary Row.
     *
     * @return self
     */
    public function setSupportCustomAccountSummaryRow($support_custom_account_summary_row)
    {
        $this->container['support_custom_account_summary_row'] = $support_custom_account_summary_row;

        return $this;
    }

    /**
     * Gets support_position_custom_fields
     *
     * @return bool|null
     */
    public function getSupportPositionCustomFields()
    {
        return $this->container['support_position_custom_fields'];
    }

    /**
     * Sets support_position_custom_fields
     *
     * @param bool|null $support_position_custom_fields Whether the integration supports custom fields for position.
     *
     * @return self
     */
    public function setSupportPositionCustomFields($support_position_custom_fields)
    {
        $this->container['support_position_custom_fields'] = $support_position_custom_fields;

        return $this;
    }

    /**
     * Gets support_order_custom_fields
     *
     * @return bool|null
     */
    public function getSupportOrderCustomFields()
    {
        return $this->container['support_order_custom_fields'];
    }

    /**
     * Sets support_order_custom_fields
     *
     * @param bool|null $support_order_custom_fields Whether the integration supports custom fields for order.
     *
     * @return self
     */
    public function setSupportOrderCustomFields($support_order_custom_fields)
    {
        $this->container['support_order_custom_fields'] = $support_order_custom_fields;

        return $this;
    }

    /**
     * Gets support_order_history_custom_fields
     *
     * @return bool|null
     */
    public function getSupportOrderHistoryCustomFields()
    {
        return $this->container['support_order_history_custom_fields'];
    }

    /**
     * Sets support_order_history_custom_fields
     *
     * @param bool|null $support_order_history_custom_fields Whether the integration supports custom fields for order history.
     *
     * @return self
     */
    public function setSupportOrderHistoryCustomFields($support_order_history_custom_fields)
    {
        $this->container['support_order_history_custom_fields'] = $support_order_history_custom_fields;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


