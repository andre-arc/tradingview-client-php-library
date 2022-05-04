<?php
/**
 * Instrument
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
 * Instrument Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Instrument implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Instrument';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'description' => 'string',
        'min_qty' => 'float',
        'max_qty' => 'float',
        'qty_step' => 'float',
        'pip_size' => 'float',
        'pip_value' => 'float',
        'min_tick' => 'float',
        'lot_size' => 'float',
        'base_currency' => 'string',
        'quote_currency' => 'string',
        'margin_rate' => 'float',
        'has_quotes' => 'bool',
        'units' => 'string',
        'type' => '\OpenAPI\Client\Model\SymbolType',
        'ui' => '\OpenAPI\Client\Model\InstrumentUi'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'name' => null,
        'description' => null,
        'min_qty' => null,
        'max_qty' => null,
        'qty_step' => null,
        'pip_size' => null,
        'pip_value' => null,
        'min_tick' => null,
        'lot_size' => null,
        'base_currency' => null,
        'quote_currency' => null,
        'margin_rate' => null,
        'has_quotes' => null,
        'units' => null,
        'type' => null,
        'ui' => null
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
        'name' => 'name',
        'description' => 'description',
        'min_qty' => 'minQty',
        'max_qty' => 'maxQty',
        'qty_step' => 'qtyStep',
        'pip_size' => 'pipSize',
        'pip_value' => 'pipValue',
        'min_tick' => 'minTick',
        'lot_size' => 'lotSize',
        'base_currency' => 'baseCurrency',
        'quote_currency' => 'quoteCurrency',
        'margin_rate' => 'marginRate',
        'has_quotes' => 'hasQuotes',
        'units' => 'units',
        'type' => 'type',
        'ui' => 'ui'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'description' => 'setDescription',
        'min_qty' => 'setMinQty',
        'max_qty' => 'setMaxQty',
        'qty_step' => 'setQtyStep',
        'pip_size' => 'setPipSize',
        'pip_value' => 'setPipValue',
        'min_tick' => 'setMinTick',
        'lot_size' => 'setLotSize',
        'base_currency' => 'setBaseCurrency',
        'quote_currency' => 'setQuoteCurrency',
        'margin_rate' => 'setMarginRate',
        'has_quotes' => 'setHasQuotes',
        'units' => 'setUnits',
        'type' => 'setType',
        'ui' => 'setUi'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'description' => 'getDescription',
        'min_qty' => 'getMinQty',
        'max_qty' => 'getMaxQty',
        'qty_step' => 'getQtyStep',
        'pip_size' => 'getPipSize',
        'pip_value' => 'getPipValue',
        'min_tick' => 'getMinTick',
        'lot_size' => 'getLotSize',
        'base_currency' => 'getBaseCurrency',
        'quote_currency' => 'getQuoteCurrency',
        'margin_rate' => 'getMarginRate',
        'has_quotes' => 'getHasQuotes',
        'units' => 'getUnits',
        'type' => 'getType',
        'ui' => 'getUi'
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
        $this->container['name'] = $data['name'] ?? null;
        $this->container['description'] = $data['description'] ?? null;
        $this->container['min_qty'] = $data['min_qty'] ?? null;
        $this->container['max_qty'] = $data['max_qty'] ?? null;
        $this->container['qty_step'] = $data['qty_step'] ?? null;
        $this->container['pip_size'] = $data['pip_size'] ?? null;
        $this->container['pip_value'] = $data['pip_value'] ?? null;
        $this->container['min_tick'] = $data['min_tick'] ?? null;
        $this->container['lot_size'] = $data['lot_size'] ?? null;
        $this->container['base_currency'] = $data['base_currency'] ?? null;
        $this->container['quote_currency'] = $data['quote_currency'] ?? null;
        $this->container['margin_rate'] = $data['margin_rate'] ?? null;
        $this->container['has_quotes'] = $data['has_quotes'] ?? true;
        $this->container['units'] = $data['units'] ?? null;
        $this->container['type'] = $data['type'] ?? null;
        $this->container['ui'] = $data['ui'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['pip_size'] === null) {
            $invalidProperties[] = "'pip_size' can't be null";
        }
        if ($this->container['pip_value'] === null) {
            $invalidProperties[] = "'pip_value' can't be null";
        }
        if ($this->container['min_tick'] === null) {
            $invalidProperties[] = "'min_tick' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Broker instrument name.
     *
     * @return self
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description Instrument description.
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets min_qty
     *
     * @return float|null
     */
    public function getMinQty()
    {
        return $this->container['min_qty'];
    }

    /**
     * Sets min_qty
     *
     * @param float|null $min_qty Minimum quantity for trading. If `lotSize` is set, then the specified value must be in lots.
     *
     * @return self
     */
    public function setMinQty($min_qty)
    {
        $this->container['min_qty'] = $min_qty;

        return $this;
    }

    /**
     * Gets max_qty
     *
     * @return float|null
     */
    public function getMaxQty()
    {
        return $this->container['max_qty'];
    }

    /**
     * Sets max_qty
     *
     * @param float|null $max_qty Maximum quantity for trading. If `lotSize` is set, then the specified value must be in lots.
     *
     * @return self
     */
    public function setMaxQty($max_qty)
    {
        $this->container['max_qty'] = $max_qty;

        return $this;
    }

    /**
     * Gets qty_step
     *
     * @return float|null
     */
    public function getQtyStep()
    {
        return $this->container['qty_step'];
    }

    /**
     * Sets qty_step
     *
     * @param float|null $qty_step Quantity step. If `lotSize` is set, then the specified value must be in lots.
     *
     * @return self
     */
    public function setQtyStep($qty_step)
    {
        $this->container['qty_step'] = $qty_step;

        return $this;
    }

    /**
     * Gets pip_size
     *
     * @return float
     */
    public function getPipSize()
    {
        return $this->container['pip_size'];
    }

    /**
     * Sets pip_size
     *
     * @param float $pip_size Size of 1 pip. It is equal to `minTick` for non-forex symbols. For forex pairs it equals either the `minTick`, or the `minTick` multiplied by `10`. For example, for IBM `minTick` it is 0.01, for EURCAD `minTick` it is 0.00001.
     *
     * @return self
     */
    public function setPipSize($pip_size)
    {
        $this->container['pip_size'] = $pip_size;

        return $this;
    }

    /**
     * Gets pip_value
     *
     * @return float
     */
    public function getPipValue()
    {
        return $this->container['pip_value'];
    }

    /**
     * Sets pip_value
     *
     * @param float $pip_value Value of 1 pip in the account currency.
     *
     * @return self
     */
    public function setPipValue($pip_value)
    {
        $this->container['pip_value'] = $pip_value;

        return $this;
    }

    /**
     * Gets min_tick
     *
     * @return float
     */
    public function getMinTick()
    {
        return $this->container['min_tick'];
    }

    /**
     * Sets min_tick
     *
     * @param float $min_tick Minimum price movement. For example, for IBM `minTick` is 0.01, for EURCAD `minTick` is 0.00001.
     *
     * @return self
     */
    public function setMinTick($min_tick)
    {
        $this->container['min_tick'] = $min_tick;

        return $this;
    }

    /**
     * Gets lot_size
     *
     * @return float|null
     */
    public function getLotSize()
    {
        return $this->container['lot_size'];
    }

    /**
     * Sets lot_size
     *
     * @param float|null $lot_size Financial instrument units standardized number as set by the exchange or broker for buying or selling.
     *
     * @return self
     */
    public function setLotSize($lot_size)
    {
        $this->container['lot_size'] = $lot_size;

        return $this;
    }

    /**
     * Gets base_currency
     *
     * @return string|null
     */
    public function getBaseCurrency()
    {
        return $this->container['base_currency'];
    }

    /**
     * Sets base_currency
     *
     * @param string|null $base_currency The first currency quoted in a currency pair. Used for crypto currencies only.
     *
     * @return self
     */
    public function setBaseCurrency($base_currency)
    {
        $this->container['base_currency'] = $base_currency;

        return $this;
    }

    /**
     * Gets quote_currency
     *
     * @return string|null
     */
    public function getQuoteCurrency()
    {
        return $this->container['quote_currency'];
    }

    /**
     * Sets quote_currency
     *
     * @param string|null $quote_currency A quote currency is the second currency quoted in a currency pair. Used for crypto currencies only.
     *
     * @return self
     */
    public function setQuoteCurrency($quote_currency)
    {
        $this->container['quote_currency'] = $quote_currency;

        return $this;
    }

    /**
     * Gets margin_rate
     *
     * @return float|null
     */
    public function getMarginRate()
    {
        return $this->container['margin_rate'];
    }

    /**
     * Sets margin_rate
     *
     * @param float|null $margin_rate Margin rate for this instrument.
     *
     * @return self
     */
    public function setMarginRate($margin_rate)
    {
        $this->container['margin_rate'] = $margin_rate;

        return $this;
    }

    /**
     * Gets has_quotes
     *
     * @return bool|null
     */
    public function getHasQuotes()
    {
        return $this->container['has_quotes'];
    }

    /**
     * Sets has_quotes
     *
     * @param bool|null $has_quotes Indicates if your API provides quotes for this instrument. Assigning `false` to this field prevents `/quotes` request and makes ask/bid displayed from a TradingView server depending on users data subscriptions on TradingView. Use of this flag must be agreed with TradingView
     *
     * @return self
     */
    public function setHasQuotes($has_quotes)
    {
        $this->container['has_quotes'] = $has_quotes;

        return $this;
    }

    /**
     * Gets units
     *
     * @return string|null
     */
    public function getUnits()
    {
        return $this->container['units'];
    }

    /**
     * Sets units
     *
     * @param string|null $units Units of quantity or amount. Displayed instead of the `Units` label in the Quantity/Amount field
     *
     * @return self
     */
    public function setUnits($units)
    {
        $this->container['units'] = $units;

        return $this;
    }

    /**
     * Gets type
     *
     * @return \OpenAPI\Client\Model\SymbolType
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param \OpenAPI\Client\Model\SymbolType $type type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets ui
     *
     * @return \OpenAPI\Client\Model\InstrumentUi|null
     */
    public function getUi()
    {
        return $this->container['ui'];
    }

    /**
     * Sets ui
     *
     * @param \OpenAPI\Client\Model\InstrumentUi|null $ui ui
     *
     * @return self
     */
    public function setUi($ui)
    {
        $this->container['ui'] = $ui;

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


