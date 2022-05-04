<?php
/**
 * Execution
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
 * Execution Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Execution implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Execution';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'instrument' => 'string',
        'price' => 'float',
        'time' => 'float',
        'qty' => 'float',
        'side' => 'string',
        'order_id' => 'string',
        'is_close' => 'bool',
        'position_id' => 'string',
        'commission' => 'float'
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
        'price' => null,
        'time' => null,
        'qty' => null,
        'side' => null,
        'order_id' => null,
        'is_close' => null,
        'position_id' => null,
        'commission' => null
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
        'price' => 'price',
        'time' => 'time',
        'qty' => 'qty',
        'side' => 'side',
        'order_id' => 'orderId',
        'is_close' => 'isClose',
        'position_id' => 'positionId',
        'commission' => 'commission'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'instrument' => 'setInstrument',
        'price' => 'setPrice',
        'time' => 'setTime',
        'qty' => 'setQty',
        'side' => 'setSide',
        'order_id' => 'setOrderId',
        'is_close' => 'setIsClose',
        'position_id' => 'setPositionId',
        'commission' => 'setCommission'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'instrument' => 'getInstrument',
        'price' => 'getPrice',
        'time' => 'getTime',
        'qty' => 'getQty',
        'side' => 'getSide',
        'order_id' => 'getOrderId',
        'is_close' => 'getIsClose',
        'position_id' => 'getPositionId',
        'commission' => 'getCommission'
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
        $this->container['price'] = $data['price'] ?? null;
        $this->container['time'] = $data['time'] ?? null;
        $this->container['qty'] = $data['qty'] ?? null;
        $this->container['side'] = $data['side'] ?? null;
        $this->container['order_id'] = $data['order_id'] ?? null;
        $this->container['is_close'] = $data['is_close'] ?? null;
        $this->container['position_id'] = $data['position_id'] ?? null;
        $this->container['commission'] = $data['commission'] ?? null;
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
        if ($this->container['price'] === null) {
            $invalidProperties[] = "'price' can't be null";
        }
        if ($this->container['time'] === null) {
            $invalidProperties[] = "'time' can't be null";
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

        if ($this->container['order_id'] === null) {
            $invalidProperties[] = "'order_id' can't be null";
        }
        if ($this->container['is_close'] === null) {
            $invalidProperties[] = "'is_close' can't be null";
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
     * @param string $instrument Instrument id.
     *
     * @return self
     */
    public function setInstrument($instrument)
    {
        $this->container['instrument'] = $instrument;

        return $this;
    }

    /**
     * Gets price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->container['price'];
    }

    /**
     * Sets price
     *
     * @param float $price Execution price.
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->container['price'] = $price;

        return $this;
    }

    /**
     * Gets time
     *
     * @return float
     */
    public function getTime()
    {
        return $this->container['time'];
    }

    /**
     * Sets time
     *
     * @param float $time Execution time, Unix timestamp (UTC).
     *
     * @return self
     */
    public function setTime($time)
    {
        $this->container['time'] = $time;

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
     * @param float $qty Execution quantity.
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
     * Gets order_id
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->container['order_id'];
    }

    /**
     * Sets order_id
     *
     * @param string $order_id Identifier of the order that has been filled.
     *
     * @return self
     */
    public function setOrderId($order_id)
    {
        $this->container['order_id'] = $order_id;

        return $this;
    }

    /**
     * Gets is_close
     *
     * @return bool
     */
    public function getIsClose()
    {
        return $this->container['is_close'];
    }

    /**
     * Sets is_close
     *
     * @param bool $is_close Whether the execution reduces the position.
     *
     * @return self
     */
    public function setIsClose($is_close)
    {
        $this->container['is_close'] = $is_close;

        return $this;
    }

    /**
     * Gets position_id
     *
     * @return string|null
     */
    public function getPositionId()
    {
        return $this->container['position_id'];
    }

    /**
     * Sets position_id
     *
     * @param string|null $position_id Identifier of the position that has been opened, modified or closed.
     *
     * @return self
     */
    public function setPositionId($position_id)
    {
        $this->container['position_id'] = $position_id;

        return $this;
    }

    /**
     * Gets commission
     *
     * @return float|null
     */
    public function getCommission()
    {
        return $this->container['commission'];
    }

    /**
     * Sets commission
     *
     * @param float|null $commission Commission charged for the fill.
     *
     * @return self
     */
    public function setCommission($commission)
    {
        $this->container['commission'] = $commission;

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


