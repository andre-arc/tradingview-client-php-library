<?php
/**
 * Order
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
 * Order Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Order implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Order';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'instrument' => 'string',
        'qty' => 'float',
        'side' => 'string',
        'type' => 'string',
        'filled_qty' => 'float',
        'avg_price' => 'float',
        'limit_price' => 'float',
        'stop_price' => 'float',
        'trailing_stop_pips' => 'float',
        'is_trailing_stop' => 'bool',
        'parent_id' => 'string',
        'parent_type' => 'string',
        'duration' => '\OpenAPI\Client\Model\OrderCommonDuration',
        'last_modified' => 'float',
        'custom_fields' => '\OpenAPI\Client\Model\CustomFieldsValueItem[]',
        'message' => '\OpenAPI\Client\Model\Message',
        'status' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'instrument' => null,
        'qty' => null,
        'side' => null,
        'type' => null,
        'filled_qty' => null,
        'avg_price' => null,
        'limit_price' => null,
        'stop_price' => null,
        'trailing_stop_pips' => null,
        'is_trailing_stop' => null,
        'parent_id' => null,
        'parent_type' => null,
        'duration' => null,
        'last_modified' => null,
        'custom_fields' => null,
        'message' => null,
        'status' => null
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
        'id' => 'id',
        'instrument' => 'instrument',
        'qty' => 'qty',
        'side' => 'side',
        'type' => 'type',
        'filled_qty' => 'filledQty',
        'avg_price' => 'avgPrice',
        'limit_price' => 'limitPrice',
        'stop_price' => 'stopPrice',
        'trailing_stop_pips' => 'trailingStopPips',
        'is_trailing_stop' => 'isTrailingStop',
        'parent_id' => 'parentId',
        'parent_type' => 'parentType',
        'duration' => 'duration',
        'last_modified' => 'lastModified',
        'custom_fields' => 'customFields',
        'message' => 'message',
        'status' => 'status'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'instrument' => 'setInstrument',
        'qty' => 'setQty',
        'side' => 'setSide',
        'type' => 'setType',
        'filled_qty' => 'setFilledQty',
        'avg_price' => 'setAvgPrice',
        'limit_price' => 'setLimitPrice',
        'stop_price' => 'setStopPrice',
        'trailing_stop_pips' => 'setTrailingStopPips',
        'is_trailing_stop' => 'setIsTrailingStop',
        'parent_id' => 'setParentId',
        'parent_type' => 'setParentType',
        'duration' => 'setDuration',
        'last_modified' => 'setLastModified',
        'custom_fields' => 'setCustomFields',
        'message' => 'setMessage',
        'status' => 'setStatus'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'instrument' => 'getInstrument',
        'qty' => 'getQty',
        'side' => 'getSide',
        'type' => 'getType',
        'filled_qty' => 'getFilledQty',
        'avg_price' => 'getAvgPrice',
        'limit_price' => 'getLimitPrice',
        'stop_price' => 'getStopPrice',
        'trailing_stop_pips' => 'getTrailingStopPips',
        'is_trailing_stop' => 'getIsTrailingStop',
        'parent_id' => 'getParentId',
        'parent_type' => 'getParentType',
        'duration' => 'getDuration',
        'last_modified' => 'getLastModified',
        'custom_fields' => 'getCustomFields',
        'message' => 'getMessage',
        'status' => 'getStatus'
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

    const SIDE_BUY = 'buy';
    const SIDE_SELL = 'sell';
    const TYPE_MARKET = 'market';
    const TYPE_STOP = 'stop';
    const TYPE_LIMIT = 'limit';
    const TYPE_STOPLIMIT = 'stoplimit';
    const PARENT_TYPE_ORDER = 'order';
    const PARENT_TYPE_POSITION = 'position';
    const STATUS_PLACING = 'placing';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_WORKING = 'working';
    const STATUS_REJECTED = 'rejected';
    const STATUS_FILLED = 'filled';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSideAllowableValues()
    {
        return [
            self::SIDE_BUY,
            self::SIDE_SELL,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_MARKET,
            self::TYPE_STOP,
            self::TYPE_LIMIT,
            self::TYPE_STOPLIMIT,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getParentTypeAllowableValues()
    {
        return [
            self::PARENT_TYPE_ORDER,
            self::PARENT_TYPE_POSITION,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_PLACING,
            self::STATUS_INACTIVE,
            self::STATUS_WORKING,
            self::STATUS_REJECTED,
            self::STATUS_FILLED,
            self::STATUS_CANCELLED,
        ];
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
        $this->container['id'] = $data['id'] ?? null;
        $this->container['instrument'] = $data['instrument'] ?? null;
        $this->container['qty'] = $data['qty'] ?? null;
        $this->container['side'] = $data['side'] ?? null;
        $this->container['type'] = $data['type'] ?? null;
        $this->container['filled_qty'] = $data['filled_qty'] ?? null;
        $this->container['avg_price'] = $data['avg_price'] ?? null;
        $this->container['limit_price'] = $data['limit_price'] ?? null;
        $this->container['stop_price'] = $data['stop_price'] ?? null;
        $this->container['trailing_stop_pips'] = $data['trailing_stop_pips'] ?? null;
        $this->container['is_trailing_stop'] = $data['is_trailing_stop'] ?? null;
        $this->container['parent_id'] = $data['parent_id'] ?? null;
        $this->container['parent_type'] = $data['parent_type'] ?? null;
        $this->container['duration'] = $data['duration'] ?? null;
        $this->container['last_modified'] = $data['last_modified'] ?? null;
        $this->container['custom_fields'] = $data['custom_fields'] ?? null;
        $this->container['message'] = $data['message'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['instrument'] === null) {
            $invalidProperties[] = "'instrument' can't be null";
        }
        if ($this->container['qty'] === null) {
            $invalidProperties[] = "'qty' can't be null";
        }
        if ($this->container['side'] === null) {
            $invalidProperties[] = "'side' can't be null";
        }
        $allowedValues = $this->getSideAllowableValues();
        if (!is_null($this->container['side']) && !in_array($this->container['side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'side', must be one of '%s'",
                $this->container['side'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getParentTypeAllowableValues();
        if (!is_null($this->container['parent_type']) && !in_array($this->container['parent_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'parent_type', must be one of '%s'",
                $this->container['parent_type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['custom_fields']) && (count($this->container['custom_fields']) < 1)) {
            $invalidProperties[] = "invalid value for 'custom_fields', number of items must be greater than or equal to 1.";
        }

        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

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
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id Unique identifier.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets instrument
     *
     * @return string
     */
    public function getInstrument()
    {
        return $this->container['instrument'];
    }

    /**
     * Sets instrument
     *
     * @param string $instrument Instrument name that is used on a broker's side.
     *
     * @return self
     */
    public function setInstrument($instrument)
    {
        $this->container['instrument'] = $instrument;

        return $this;
    }

    /**
     * Gets qty
     *
     * @return float
     */
    public function getQty()
    {
        return $this->container['qty'];
    }

    /**
     * Sets qty
     *
     * @param float $qty Quantity.
     *
     * @return self
     */
    public function setQty($qty)
    {
        $this->container['qty'] = $qty;

        return $this;
    }

    /**
     * Gets side
     *
     * @return string
     */
    public function getSide()
    {
        return $this->container['side'];
    }

    /**
     * Sets side
     *
     * @param string $side Side.
     *
     * @return self
     */
    public function setSide($side)
    {
        $allowedValues = $this->getSideAllowableValues();
        if (!in_array($side, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'side', must be one of '%s'",
                    $side,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['side'] = $side;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type Type.
     *
     * @return self
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets filled_qty
     *
     * @return float|null
     */
    public function getFilledQty()
    {
        return $this->container['filled_qty'];
    }

    /**
     * Sets filled_qty
     *
     * @param float|null $filled_qty Filled quantity.
     *
     * @return self
     */
    public function setFilledQty($filled_qty)
    {
        $this->container['filled_qty'] = $filled_qty;

        return $this;
    }

    /**
     * Gets avg_price
     *
     * @return float|null
     */
    public function getAvgPrice()
    {
        return $this->container['avg_price'];
    }

    /**
     * Sets avg_price
     *
     * @param float|null $avg_price Average price of order fills. It should be provided for filled / partly filled orders.
     *
     * @return self
     */
    public function setAvgPrice($avg_price)
    {
        $this->container['avg_price'] = $avg_price;

        return $this;
    }

    /**
     * Gets limit_price
     *
     * @return float|null
     */
    public function getLimitPrice()
    {
        return $this->container['limit_price'];
    }

    /**
     * Sets limit_price
     *
     * @param float|null $limit_price Limit Price for Limit or StopLimit order.
     *
     * @return self
     */
    public function setLimitPrice($limit_price)
    {
        $this->container['limit_price'] = $limit_price;

        return $this;
    }

    /**
     * Gets stop_price
     *
     * @return float|null
     */
    public function getStopPrice()
    {
        return $this->container['stop_price'];
    }

    /**
     * Sets stop_price
     *
     * @param float|null $stop_price Stop Price for Stop or StopLimit order.
     *
     * @return self
     */
    public function setStopPrice($stop_price)
    {
        $this->container['stop_price'] = $stop_price;

        return $this;
    }

    /**
     * Gets trailing_stop_pips
     *
     * @return float|null
     */
    public function getTrailingStopPips()
    {
        return $this->container['trailing_stop_pips'];
    }

    /**
     * Sets trailing_stop_pips
     *
     * @param float|null $trailing_stop_pips Distance from the stop loss level to the current market price in pips for a position or to the order price if the parent is a stop or limit order.
     *
     * @return self
     */
    public function setTrailingStopPips($trailing_stop_pips)
    {
        $this->container['trailing_stop_pips'] = $trailing_stop_pips;

        return $this;
    }

    /**
     * Gets is_trailing_stop
     *
     * @return bool|null
     */
    public function getIsTrailingStop()
    {
        return $this->container['is_trailing_stop'];
    }

    /**
     * Sets is_trailing_stop
     *
     * @param bool|null $is_trailing_stop If this flag is set to `true`, then the stop order is a trailing stop.
     *
     * @return self
     */
    public function setIsTrailingStop($is_trailing_stop)
    {
        $this->container['is_trailing_stop'] = $is_trailing_stop;

        return $this;
    }

    /**
     * Gets parent_id
     *
     * @return string|null
     */
    public function getParentId()
    {
        return $this->container['parent_id'];
    }

    /**
     * Sets parent_id
     *
     * @param string|null $parent_id Identifier of a parent order or a parent position (for position brackets) depending on `parentType`. Should be set only for bracket orders.
     *
     * @return self
     */
    public function setParentId($parent_id)
    {
        $this->container['parent_id'] = $parent_id;

        return $this;
    }

    /**
     * Gets parent_type
     *
     * @return string|null
     */
    public function getParentType()
    {
        return $this->container['parent_type'];
    }

    /**
     * Sets parent_type
     *
     * @param string|null $parent_type Type of order's parent. Should be set only for bracket orders.
     *
     * @return self
     */
    public function setParentType($parent_type)
    {
        $allowedValues = $this->getParentTypeAllowableValues();
        if (!is_null($parent_type) && !in_array($parent_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'parent_type', must be one of '%s'",
                    $parent_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['parent_type'] = $parent_type;

        return $this;
    }

    /**
     * Gets duration
     *
     * @return \OpenAPI\Client\Model\OrderCommonDuration|null
     */
    public function getDuration()
    {
        return $this->container['duration'];
    }

    /**
     * Sets duration
     *
     * @param \OpenAPI\Client\Model\OrderCommonDuration|null $duration duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        $this->container['duration'] = $duration;

        return $this;
    }

    /**
     * Gets last_modified
     *
     * @return float|null
     */
    public function getLastModified()
    {
        return $this->container['last_modified'];
    }

    /**
     * Sets last_modified
     *
     * @param float|null $last_modified Indicates the time when the order was last modified, Unix timestamp (UTC).
     *
     * @return self
     */
    public function setLastModified($last_modified)
    {
        $this->container['last_modified'] = $last_modified;

        return $this;
    }

    /**
     * Gets custom_fields
     *
     * @return \OpenAPI\Client\Model\CustomFieldsValueItem[]|null
     */
    public function getCustomFields()
    {
        return $this->container['custom_fields'];
    }

    /**
     * Sets custom_fields
     *
     * @param \OpenAPI\Client\Model\CustomFieldsValueItem[]|null $custom_fields Localized order custom fields values data. Custom fields are configured in the [/config](#operation/getConfiguration) endpoint response. Custom `Order dialog` fields are to be sent along with the standard fields in the order object.
     *
     * @return self
     */
    public function setCustomFields($custom_fields)
    {


        if (!is_null($custom_fields) && (count($custom_fields) < 1)) {
            throw new \InvalidArgumentException('invalid length for $custom_fields when calling Order., number of items must be greater than or equal to 1.');
        }
        $this->container['custom_fields'] = $custom_fields;

        return $this;
    }

    /**
     * Gets message
     *
     * @return \OpenAPI\Client\Model\Message|null
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param \OpenAPI\Client\Model\Message|null $message message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status String constants to describe an order status.  `Status`  | Description ----------|------------- placing   | order is not created on a broker's side yet inactive  | bracket order is created but waiting for a base order to be filled working   | order is created but not fully executed yet rejected  | order is rejected for some reason filled    | order is fully executed cancelled  | order is cancelled
     *
     * @return self
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

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


