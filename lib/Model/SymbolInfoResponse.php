<?php
/**
 * SymbolInfoResponse
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
 * SymbolInfoResponse Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class SymbolInfoResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SymbolInfoResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        's' => 'string',
        'symbol' => 'string[]',
        'description' => 'string[]',
        'currency' => 'string[]',
        'base_currency' => 'string[]',
        'exchange_listed' => 'string[]',
        'exchange_traded' => 'string[]',
        'minmovement' => 'float[]',
        'minmovement2' => 'float[]',
        'fractional' => 'bool[]',
        'pricescale' => 'float[]',
        'root' => 'string[]',
        'root_description' => 'string[]',
        'has_intraday' => 'bool[]',
        'has_no_volume' => 'bool[]',
        'type' => '\OpenAPI\Client\Model\SymbolType[]',
        'is_cfd' => 'bool[]',
        'ticker' => 'string[]',
        'timezone' => 'string[]',
        'session_regular' => 'string[]',
        'session_extended' => 'string[]',
        'session_premarket' => 'string[]',
        'session_postmarket' => 'string[]',
        'supported_resolutions' => 'string[][]',
        'has_daily' => 'bool[]',
        'intraday_multipliers' => 'string[][]',
        'has_weekly_and_monthly' => 'bool[]',
        'pointvalue' => 'float[]',
        'expiration' => 'float[]',
        'bar_source' => 'string[]',
        'bar_transform' => 'string[]',
        'bar_fillgaps' => 'bool[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        's' => null,
        'symbol' => null,
        'description' => null,
        'currency' => null,
        'base_currency' => null,
        'exchange_listed' => null,
        'exchange_traded' => null,
        'minmovement' => null,
        'minmovement2' => null,
        'fractional' => null,
        'pricescale' => null,
        'root' => null,
        'root_description' => null,
        'has_intraday' => null,
        'has_no_volume' => null,
        'type' => null,
        'is_cfd' => null,
        'ticker' => null,
        'timezone' => null,
        'session_regular' => null,
        'session_extended' => null,
        'session_premarket' => null,
        'session_postmarket' => null,
        'supported_resolutions' => null,
        'has_daily' => null,
        'intraday_multipliers' => null,
        'has_weekly_and_monthly' => null,
        'pointvalue' => null,
        'expiration' => null,
        'bar_source' => null,
        'bar_transform' => null,
        'bar_fillgaps' => null
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
        's' => 's',
        'symbol' => 'symbol',
        'description' => 'description',
        'currency' => 'currency',
        'base_currency' => 'base-currency',
        'exchange_listed' => 'exchange-listed',
        'exchange_traded' => 'exchange-traded',
        'minmovement' => 'minmovement',
        'minmovement2' => 'minmovement2',
        'fractional' => 'fractional',
        'pricescale' => 'pricescale',
        'root' => 'root',
        'root_description' => 'root-description',
        'has_intraday' => 'has-intraday',
        'has_no_volume' => 'has-no-volume',
        'type' => 'type',
        'is_cfd' => 'is-cfd',
        'ticker' => 'ticker',
        'timezone' => 'timezone',
        'session_regular' => 'session-regular',
        'session_extended' => 'session-extended',
        'session_premarket' => 'session-premarket',
        'session_postmarket' => 'session-postmarket',
        'supported_resolutions' => 'supported-resolutions',
        'has_daily' => 'has-daily',
        'intraday_multipliers' => 'intraday-multipliers',
        'has_weekly_and_monthly' => 'has-weekly-and-monthly',
        'pointvalue' => 'pointvalue',
        'expiration' => 'expiration',
        'bar_source' => 'bar-source',
        'bar_transform' => 'bar-transform',
        'bar_fillgaps' => 'bar-fillgaps'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        's' => 'setS',
        'symbol' => 'setSymbol',
        'description' => 'setDescription',
        'currency' => 'setCurrency',
        'base_currency' => 'setBaseCurrency',
        'exchange_listed' => 'setExchangeListed',
        'exchange_traded' => 'setExchangeTraded',
        'minmovement' => 'setMinmovement',
        'minmovement2' => 'setMinmovement2',
        'fractional' => 'setFractional',
        'pricescale' => 'setPricescale',
        'root' => 'setRoot',
        'root_description' => 'setRootDescription',
        'has_intraday' => 'setHasIntraday',
        'has_no_volume' => 'setHasNoVolume',
        'type' => 'setType',
        'is_cfd' => 'setIsCfd',
        'ticker' => 'setTicker',
        'timezone' => 'setTimezone',
        'session_regular' => 'setSessionRegular',
        'session_extended' => 'setSessionExtended',
        'session_premarket' => 'setSessionPremarket',
        'session_postmarket' => 'setSessionPostmarket',
        'supported_resolutions' => 'setSupportedResolutions',
        'has_daily' => 'setHasDaily',
        'intraday_multipliers' => 'setIntradayMultipliers',
        'has_weekly_and_monthly' => 'setHasWeeklyAndMonthly',
        'pointvalue' => 'setPointvalue',
        'expiration' => 'setExpiration',
        'bar_source' => 'setBarSource',
        'bar_transform' => 'setBarTransform',
        'bar_fillgaps' => 'setBarFillgaps'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        's' => 'getS',
        'symbol' => 'getSymbol',
        'description' => 'getDescription',
        'currency' => 'getCurrency',
        'base_currency' => 'getBaseCurrency',
        'exchange_listed' => 'getExchangeListed',
        'exchange_traded' => 'getExchangeTraded',
        'minmovement' => 'getMinmovement',
        'minmovement2' => 'getMinmovement2',
        'fractional' => 'getFractional',
        'pricescale' => 'getPricescale',
        'root' => 'getRoot',
        'root_description' => 'getRootDescription',
        'has_intraday' => 'getHasIntraday',
        'has_no_volume' => 'getHasNoVolume',
        'type' => 'getType',
        'is_cfd' => 'getIsCfd',
        'ticker' => 'getTicker',
        'timezone' => 'getTimezone',
        'session_regular' => 'getSessionRegular',
        'session_extended' => 'getSessionExtended',
        'session_premarket' => 'getSessionPremarket',
        'session_postmarket' => 'getSessionPostmarket',
        'supported_resolutions' => 'getSupportedResolutions',
        'has_daily' => 'getHasDaily',
        'intraday_multipliers' => 'getIntradayMultipliers',
        'has_weekly_and_monthly' => 'getHasWeeklyAndMonthly',
        'pointvalue' => 'getPointvalue',
        'expiration' => 'getExpiration',
        'bar_source' => 'getBarSource',
        'bar_transform' => 'getBarTransform',
        'bar_fillgaps' => 'getBarFillgaps'
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

    const S_OK = 'ok';
    const TIMEZONE_AMERICA_NEW_YORK = 'America/New_York';
    const TIMEZONE_AMERICA_LOS_ANGELES = 'America/Los_Angeles';
    const TIMEZONE_AMERICA_CHICAGO = 'America/Chicago';
    const TIMEZONE_AMERICA_PHOENIX = 'America/Phoenix';
    const TIMEZONE_AMERICA_TORONTO = 'America/Toronto';
    const TIMEZONE_AMERICA_VANCOUVER = 'America/Vancouver';
    const TIMEZONE_AMERICA_ARGENTINA_BUENOS_AIRES = 'America/Argentina/Buenos_Aires';
    const TIMEZONE_AMERICA_EL_SALVADOR = 'America/El_Salvador';
    const TIMEZONE_AMERICA_SAO_PAULO = 'America/Sao_Paulo';
    const TIMEZONE_AMERICA_BOGOTA = 'America/Bogota';
    const TIMEZONE_EUROPE_MOSCOW = 'Europe/Moscow';
    const TIMEZONE_EUROPE_ATHENS = 'Europe/Athens';
    const TIMEZONE_EUROPE_BERLIN = 'Europe/Berlin';
    const TIMEZONE_EUROPE_LONDON = 'Europe/London';
    const TIMEZONE_EUROPE_MADRID = 'Europe/Madrid';
    const TIMEZONE_EUROPE_PARIS = 'Europe/Paris';
    const TIMEZONE_EUROPE_WARSAW = 'Europe/Warsaw';
    const TIMEZONE_AUSTRALIA_SYDNEY = 'Australia/Sydney';
    const TIMEZONE_AUSTRALIA_BRISBANE = 'Australia/Brisbane';
    const TIMEZONE_AUSTRALIA_ADELAIDE = 'Australia/Adelaide';
    const TIMEZONE_AUSTRALIA_ACT = 'Australia/ACT';
    const TIMEZONE_ASIA_ALMATY = 'Asia/Almaty';
    const TIMEZONE_ASIA_ASHKHABAD = 'Asia/Ashkhabad';
    const TIMEZONE_ASIA_TOKYO = 'Asia/Tokyo';
    const TIMEZONE_ASIA_TAIPEI = 'Asia/Taipei';
    const TIMEZONE_ASIA_SINGAPORE = 'Asia/Singapore';
    const TIMEZONE_ASIA_SHANGHAI = 'Asia/Shanghai';
    const TIMEZONE_ASIA_SEOUL = 'Asia/Seoul';
    const TIMEZONE_ASIA_TEHRAN = 'Asia/Tehran';
    const TIMEZONE_ASIA_DUBAI = 'Asia/Dubai';
    const TIMEZONE_ASIA_KOLKATA = 'Asia/Kolkata';
    const TIMEZONE_ASIA_HONG_KONG = 'Asia/Hong_Kong';
    const TIMEZONE_ASIA_BANGKOK = 'Asia/Bangkok';
    const TIMEZONE_PACIFIC_AUCKLAND = 'Pacific/Auckland';
    const TIMEZONE_PACIFIC_CHATHAM = 'Pacific/Chatham';
    const TIMEZONE_PACIFIC_FAKAOFO = 'Pacific/Fakaofo';
    const TIMEZONE_PACIFIC_HONOLULU = 'Pacific/Honolulu';
    const TIMEZONE_AMERICA_MEXICO_CITY = 'America/Mexico_City';
    const TIMEZONE_AFRICA_JOHANNESBURG = 'Africa/Johannesburg';
    const TIMEZONE_ASIA_KATHMANDU = 'Asia/Kathmandu';
    const TIMEZONE_US_MOUNTAIN = 'US/Mountain';
    const TIMEZONE_ETC_UTC = 'Etc/UTC';
    const BAR_SOURCE_BID = 'bid';
    const BAR_SOURCE_ASK = 'ask';
    const BAR_SOURCE_MID = 'mid';
    const BAR_SOURCE_TRADE = 'trade';
    const BAR_TRANSFORM_NONE = 'none';
    const BAR_TRANSFORM_OPENPREV = 'openprev';
    const BAR_TRANSFORM_PREVOPEN = 'prevopen';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSAllowableValues()
    {
        return [
            self::S_OK,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTimezoneAllowableValues()
    {
        return [
            self::TIMEZONE_AMERICA_NEW_YORK,
            self::TIMEZONE_AMERICA_LOS_ANGELES,
            self::TIMEZONE_AMERICA_CHICAGO,
            self::TIMEZONE_AMERICA_PHOENIX,
            self::TIMEZONE_AMERICA_TORONTO,
            self::TIMEZONE_AMERICA_VANCOUVER,
            self::TIMEZONE_AMERICA_ARGENTINA_BUENOS_AIRES,
            self::TIMEZONE_AMERICA_EL_SALVADOR,
            self::TIMEZONE_AMERICA_SAO_PAULO,
            self::TIMEZONE_AMERICA_BOGOTA,
            self::TIMEZONE_EUROPE_MOSCOW,
            self::TIMEZONE_EUROPE_ATHENS,
            self::TIMEZONE_EUROPE_BERLIN,
            self::TIMEZONE_EUROPE_LONDON,
            self::TIMEZONE_EUROPE_MADRID,
            self::TIMEZONE_EUROPE_PARIS,
            self::TIMEZONE_EUROPE_WARSAW,
            self::TIMEZONE_AUSTRALIA_SYDNEY,
            self::TIMEZONE_AUSTRALIA_BRISBANE,
            self::TIMEZONE_AUSTRALIA_ADELAIDE,
            self::TIMEZONE_AUSTRALIA_ACT,
            self::TIMEZONE_ASIA_ALMATY,
            self::TIMEZONE_ASIA_ASHKHABAD,
            self::TIMEZONE_ASIA_TOKYO,
            self::TIMEZONE_ASIA_TAIPEI,
            self::TIMEZONE_ASIA_SINGAPORE,
            self::TIMEZONE_ASIA_SHANGHAI,
            self::TIMEZONE_ASIA_SEOUL,
            self::TIMEZONE_ASIA_TEHRAN,
            self::TIMEZONE_ASIA_DUBAI,
            self::TIMEZONE_ASIA_KOLKATA,
            self::TIMEZONE_ASIA_HONG_KONG,
            self::TIMEZONE_ASIA_BANGKOK,
            self::TIMEZONE_PACIFIC_AUCKLAND,
            self::TIMEZONE_PACIFIC_CHATHAM,
            self::TIMEZONE_PACIFIC_FAKAOFO,
            self::TIMEZONE_PACIFIC_HONOLULU,
            self::TIMEZONE_AMERICA_MEXICO_CITY,
            self::TIMEZONE_AFRICA_JOHANNESBURG,
            self::TIMEZONE_ASIA_KATHMANDU,
            self::TIMEZONE_US_MOUNTAIN,
            self::TIMEZONE_ETC_UTC,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getBarSourceAllowableValues()
    {
        return [
            self::BAR_SOURCE_BID,
            self::BAR_SOURCE_ASK,
            self::BAR_SOURCE_MID,
            self::BAR_SOURCE_TRADE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getBarTransformAllowableValues()
    {
        return [
            self::BAR_TRANSFORM_NONE,
            self::BAR_TRANSFORM_OPENPREV,
            self::BAR_TRANSFORM_PREVOPEN,
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
        $this->container['s'] = $data['s'] ?? null;
        $this->container['symbol'] = $data['symbol'] ?? null;
        $this->container['description'] = $data['description'] ?? null;
        $this->container['currency'] = $data['currency'] ?? null;
        $this->container['base_currency'] = $data['base_currency'] ?? null;
        $this->container['exchange_listed'] = $data['exchange_listed'] ?? null;
        $this->container['exchange_traded'] = $data['exchange_traded'] ?? null;
        $this->container['minmovement'] = $data['minmovement'] ?? null;
        $this->container['minmovement2'] = $data['minmovement2'] ?? null;
        $this->container['fractional'] = $data['fractional'] ?? null;
        $this->container['pricescale'] = $data['pricescale'] ?? null;
        $this->container['root'] = $data['root'] ?? null;
        $this->container['root_description'] = $data['root_description'] ?? null;
        $this->container['has_intraday'] = $data['has_intraday'] ?? null;
        $this->container['has_no_volume'] = $data['has_no_volume'] ?? null;
        $this->container['type'] = $data['type'] ?? null;
        $this->container['is_cfd'] = $data['is_cfd'] ?? null;
        $this->container['ticker'] = $data['ticker'] ?? null;
        $this->container['timezone'] = $data['timezone'] ?? null;
        $this->container['session_regular'] = $data['session_regular'] ?? null;
        $this->container['session_extended'] = $data['session_extended'] ?? null;
        $this->container['session_premarket'] = $data['session_premarket'] ?? null;
        $this->container['session_postmarket'] = $data['session_postmarket'] ?? null;
        $this->container['supported_resolutions'] = $data['supported_resolutions'] ?? null;
        $this->container['has_daily'] = $data['has_daily'] ?? null;
        $this->container['intraday_multipliers'] = $data['intraday_multipliers'] ?? null;
        $this->container['has_weekly_and_monthly'] = $data['has_weekly_and_monthly'] ?? null;
        $this->container['pointvalue'] = $data['pointvalue'] ?? null;
        $this->container['expiration'] = $data['expiration'] ?? null;
        $this->container['bar_source'] = $data['bar_source'] ?? null;
        $this->container['bar_transform'] = $data['bar_transform'] ?? null;
        $this->container['bar_fillgaps'] = $data['bar_fillgaps'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['s'] === null) {
            $invalidProperties[] = "'s' can't be null";
        }
        $allowedValues = $this->getSAllowableValues();
        if (!is_null($this->container['s']) && !in_array($this->container['s'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 's', must be one of '%s'",
                $this->container['s'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['symbol'] === null) {
            $invalidProperties[] = "'symbol' can't be null";
        }
        if ((count($this->container['symbol']) < 1)) {
            $invalidProperties[] = "invalid value for 'symbol', number of items must be greater than or equal to 1.";
        }

        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['currency'] === null) {
            $invalidProperties[] = "'currency' can't be null";
        }
        if ($this->container['exchange_listed'] === null) {
            $invalidProperties[] = "'exchange_listed' can't be null";
        }
        if ($this->container['exchange_traded'] === null) {
            $invalidProperties[] = "'exchange_traded' can't be null";
        }
        if ($this->container['minmovement'] === null) {
            $invalidProperties[] = "'minmovement' can't be null";
        }
        if ($this->container['pricescale'] === null) {
            $invalidProperties[] = "'pricescale' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        if ($this->container['timezone'] === null) {
            $invalidProperties[] = "'timezone' can't be null";
        }
        if ($this->container['session_regular'] === null) {
            $invalidProperties[] = "'session_regular' can't be null";
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
     * Gets s
     *
     * @return string
     */
    public function getS()
    {
        return $this->container['s'];
    }

    /**
     * Sets s
     *
     * @param string $s Status will always be `ok`.
     *
     * @return self
     */
    public function setS($s)
    {
        $allowedValues = $this->getSAllowableValues();
        if (!in_array($s, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 's', must be one of '%s'",
                    $s,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['s'] = $s;

        return $this;
    }

    /**
     * Gets symbol
     *
     * @return string[]
     */
    public function getSymbol()
    {
        return $this->container['symbol'];
    }

    /**
     * Sets symbol
     *
     * @param string[] $symbol This is the name of the symbol - a string that the users will see. It should contain uppercase letters, numbers, a dot or an underscore. Also, it will be used for data requests if you are not using tickers.
     *
     * @return self
     */
    public function setSymbol($symbol)
    {


        if ((count($symbol) < 1)) {
            throw new \InvalidArgumentException('invalid length for $symbol when calling SymbolInfoResponse., number of items must be greater than or equal to 1.');
        }
        $this->container['symbol'] = $symbol;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string[]
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string[] $description Description of a symbol. Will be displayed in the chart legend for this symbol.
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return string[]
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param string[] $currency Symbol currency, also named as counter currency. If a symbol is a currency pair, then the currency field has to contain the second currency of this pair. For example, `USD` is a currency for `EURUSD` ticker. Fiat currency must meet the ISO 4217 standard.
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets base_currency
     *
     * @return string[]|null
     */
    public function getBaseCurrency()
    {
        return $this->container['base_currency'];
    }

    /**
     * Sets base_currency
     *
     * @param string[]|null $base_currency For currency pairs only. This field contains the first currency of the pair. For example, base currency for `EURUSD` ticker is `EUR`. Fiat currency must meet the ISO 4217 standard.
     *
     * @return self
     */
    public function setBaseCurrency($base_currency)
    {
        $this->container['base_currency'] = $base_currency;

        return $this;
    }

    /**
     * Gets exchange_listed
     *
     * @return string[]
     */
    public function getExchangeListed()
    {
        return $this->container['exchange_listed'];
    }

    /**
     * Sets exchange_listed
     *
     * @param string[] $exchange_listed Short name of exchange where this symbol is listed.
     *
     * @return self
     */
    public function setExchangeListed($exchange_listed)
    {
        $this->container['exchange_listed'] = $exchange_listed;

        return $this;
    }

    /**
     * Gets exchange_traded
     *
     * @return string[]
     */
    public function getExchangeTraded()
    {
        return $this->container['exchange_traded'];
    }

    /**
     * Sets exchange_traded
     *
     * @param string[] $exchange_traded Short name of exchange where this symbol is traded.
     *
     * @return self
     */
    public function setExchangeTraded($exchange_traded)
    {
        $this->container['exchange_traded'] = $exchange_traded;

        return $this;
    }

    /**
     * Gets minmovement
     *
     * @return float[]
     */
    public function getMinmovement()
    {
        return $this->container['minmovement'];
    }

    /**
     * Sets minmovement
     *
     * @param float[] $minmovement Minimal integer price change.
     *
     * @return self
     */
    public function setMinmovement($minmovement)
    {
        $this->container['minmovement'] = $minmovement;

        return $this;
    }

    /**
     * Gets minmovement2
     *
     * @return float[]|null
     */
    public function getMinmovement2()
    {
        return $this->container['minmovement2'];
    }

    /**
     * Sets minmovement2
     *
     * @param float[]|null $minmovement2 This is a number for complex price formatting cases. The default value is `0`.
     *
     * @return self
     */
    public function setMinmovement2($minmovement2)
    {
        $this->container['minmovement2'] = $minmovement2;

        return $this;
    }

    /**
     * Gets fractional
     *
     * @return bool[]|null
     */
    public function getFractional()
    {
        return $this->container['fractional'];
    }

    /**
     * Sets fractional
     *
     * @param bool[]|null $fractional Boolean showing whether this symbol wants to have complex price formatting (see `minmov2`) or not. The default value is `false`.
     *
     * @return self
     */
    public function setFractional($fractional)
    {
        $this->container['fractional'] = $fractional;

        return $this;
    }

    /**
     * Gets pricescale
     *
     * @return float[]
     */
    public function getPricescale()
    {
        return $this->container['pricescale'];
    }

    /**
     * Sets pricescale
     *
     * @param float[] $pricescale Indicates how many decimal points the price has. For example, if the price has 2 decimal points (ex., 300.01), then `pricescale` is `100`. If it has 3 decimals, then `pricescale` is `1000` etc. If the price doesn't have decimals, set `pricescale` to `1`.
     *
     * @return self
     */
    public function setPricescale($pricescale)
    {
        $this->container['pricescale'] = $pricescale;

        return $this;
    }

    /**
     * Gets root
     *
     * @return string[]|null
     */
    public function getRoot()
    {
        return $this->container['root'];
    }

    /**
     * Sets root
     *
     * @param string[]|null $root Root of the features. It's required for futures symbol types only. Provide a null value for other symbol types.
     *
     * @return self
     */
    public function setRoot($root)
    {
        $this->container['root'] = $root;

        return $this;
    }

    /**
     * Gets root_description
     *
     * @return string[]|null
     */
    public function getRootDescription()
    {
        return $this->container['root_description'];
    }

    /**
     * Sets root_description
     *
     * @param string[]|null $root_description Short description of the futures root that will be displayed in the symbol search. It's required for futures only. Provide a null value for other symbol types.
     *
     * @return self
     */
    public function setRootDescription($root_description)
    {
        $this->container['root_description'] = $root_description;

        return $this;
    }

    /**
     * Gets has_intraday
     *
     * @return bool[]|null
     */
    public function getHasIntraday()
    {
        return $this->container['has_intraday'];
    }

    /**
     * Sets has_intraday
     *
     * @param bool[]|null $has_intraday Boolean value showing whether the symbol includes intraday (minutes) historical data. If it's `false` then all buttons for intraday resolutions will be disabled for this particular symbol. If it is set to `true`, all resolutions that are supplied directly by the datafeed must be provided in `intraday-multipliers` array. The default value is `true`.
     *
     * @return self
     */
    public function setHasIntraday($has_intraday)
    {
        $this->container['has_intraday'] = $has_intraday;

        return $this;
    }

    /**
     * Gets has_no_volume
     *
     * @return bool[]|null
     */
    public function getHasNoVolume()
    {
        return $this->container['has_no_volume'];
    }

    /**
     * Sets has_no_volume
     *
     * @param bool[]|null $has_no_volume Boolean showing whether the symbol includes volume data or not. The default value is `false`.
     *
     * @return self
     */
    public function setHasNoVolume($has_no_volume)
    {
        $this->container['has_no_volume'] = $has_no_volume;

        return $this;
    }

    /**
     * Gets type
     *
     * @return \OpenAPI\Client\Model\SymbolType[]
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param \OpenAPI\Client\Model\SymbolType[] $type Symbol type (forex/stock etc.).
     *
     * @return self
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets is_cfd
     *
     * @return bool[]|null
     */
    public function getIsCfd()
    {
        return $this->container['is_cfd'];
    }

    /**
     * Sets is_cfd
     *
     * @param bool[]|null $is_cfd Boolean value showing whether the symbol is CFD. The base instrument type is set using the type field.
     *
     * @return self
     */
    public function setIsCfd($is_cfd)
    {
        $this->container['is_cfd'] = $is_cfd;

        return $this;
    }

    /**
     * Gets ticker
     *
     * @return string[]|null
     */
    public function getTicker()
    {
        return $this->container['ticker'];
    }

    /**
     * Sets ticker
     *
     * @param string[]|null $ticker This is a unique identifier for this particular symbol in your symbology. If you specify this property then its value will be used for all data requests for this symbol.
     *
     * @return self
     */
    public function setTicker($ticker)
    {
        $this->container['ticker'] = $ticker;

        return $this;
    }

    /**
     * Gets timezone
     *
     * @return string[]
     */
    public function getTimezone()
    {
        return $this->container['timezone'];
    }

    /**
     * Sets timezone
     *
     * @param string[] $timezone Timezone of the exchange for this symbol. We expect to get the name of the time zone in olsondb format.
     *
     * @return self
     */
    public function setTimezone($timezone)
    {
        $allowedValues = $this->getTimezoneAllowableValues();
        if (array_diff($timezone, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'timezone', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['timezone'] = $timezone;

        return $this;
    }

    /**
     * Gets session_regular
     *
     * @return string[]
     */
    public function getSessionRegular()
    {
        return $this->container['session_regular'];
    }

    /**
     * Sets session_regular
     *
     * @param string[] $session_regular Session time format is HHMM-HHMM. E.g., a session that starts at 9:30 am and ends at 4:00 pm should look like `0930-1600`. There is a special case for symbols traded 24/7 (e.g., Bitcoin and other cryptocurrencies): the session string should be `24x7`. To specify an overnight session set start time greater than end time (ie, `1700-0900`). Session time is expected to be in exchange time zone.
     *
     * @return self
     */
    public function setSessionRegular($session_regular)
    {
        $this->container['session_regular'] = $session_regular;

        return $this;
    }

    /**
     * Gets session_extended
     *
     * @return string[]|null
     */
    public function getSessionExtended()
    {
        return $this->container['session_extended'];
    }

    /**
     * Sets session_extended
     *
     * @param string[]|null $session_extended An extended session, includes `session-premarket` and `session-postmarket`. The start time should be earlier or be equal to the start time of the `session-regular` and be equal to the start time of the `session-premarket` if it exists.
     *
     * @return self
     */
    public function setSessionExtended($session_extended)
    {
        $this->container['session_extended'] = $session_extended;

        return $this;
    }

    /**
     * Gets session_premarket
     *
     * @return string[]|null
     */
    public function getSessionPremarket()
    {
        return $this->container['session_premarket'];
    }

    /**
     * Sets session_premarket
     *
     * @param string[]|null $session_premarket An additional session before `session-regular`. The start time should be equal to the start time of the `session-extended`. The end time should be equal or less than the start time of the `session-regular`.
     *
     * @return self
     */
    public function setSessionPremarket($session_premarket)
    {
        $this->container['session_premarket'] = $session_premarket;

        return $this;
    }

    /**
     * Gets session_postmarket
     *
     * @return string[]|null
     */
    public function getSessionPostmarket()
    {
        return $this->container['session_postmarket'];
    }

    /**
     * Sets session_postmarket
     *
     * @param string[]|null $session_postmarket An additional session after the `session-regular`. The start time should be equal or greater than the end time of the `session-regular`. The end time should be equal to the end time of the `session-extended`.
     *
     * @return self
     */
    public function setSessionPostmarket($session_postmarket)
    {
        $this->container['session_postmarket'] = $session_postmarket;

        return $this;
    }

    /**
     * Gets supported_resolutions
     *
     * @return string[][]|null
     */
    public function getSupportedResolutions()
    {
        return $this->container['supported_resolutions'];
    }

    /**
     * Sets supported_resolutions
     *
     * @param string[][]|null $supported_resolutions An array of resolutions which should be enabled in resolutions picker for this symbol. Each item of an array is expected to be a string.
     *
     * @return self
     */
    public function setSupportedResolutions($supported_resolutions)
    {
        $this->container['supported_resolutions'] = $supported_resolutions;

        return $this;
    }

    /**
     * Gets has_daily
     *
     * @return bool[]|null
     */
    public function getHasDaily()
    {
        return $this->container['has_daily'];
    }

    /**
     * Sets has_daily
     *
     * @param bool[]|null $has_daily The boolean value showing whether data feed has its own daily resolution bars or not. If `has-daily` = `false` then Charting Library will build the respective resolutions using 1-minute bars by itself. If not, then it will request those bars from the data feed. The default value is `true`.
     *
     * @return self
     */
    public function setHasDaily($has_daily)
    {
        $this->container['has_daily'] = $has_daily;

        return $this;
    }

    /**
     * Gets intraday_multipliers
     *
     * @return string[][]|null
     */
    public function getIntradayMultipliers()
    {
        return $this->container['intraday_multipliers'];
    }

    /**
     * Sets intraday_multipliers
     *
     * @param string[][]|null $intraday_multipliers This is an array containing intraday resolutions (in minutes) that the data feed may provide. E.g., if the data feed supports resolutions such as `[\"1\", \"5\", \"15\"]`, but has 1-minute bars for some symbols then you should set `intraday-multipliers` of this symbol to `[1]`. This will make Charting Library build 5 and 15-minute resolutions by itself.
     *
     * @return self
     */
    public function setIntradayMultipliers($intraday_multipliers)
    {
        $this->container['intraday_multipliers'] = $intraday_multipliers;

        return $this;
    }

    /**
     * Gets has_weekly_and_monthly
     *
     * @return bool[]|null
     */
    public function getHasWeeklyAndMonthly()
    {
        return $this->container['has_weekly_and_monthly'];
    }

    /**
     * Sets has_weekly_and_monthly
     *
     * @param bool[]|null $has_weekly_and_monthly The boolean value showing whether data feed has its own weekly and monthly resolution bars or not. If `has-weekly-and-monthly` = `false` then Charting Library will build the respective resolutions using daily bars by itself. If not, then it will request those bars from the data feed. The default value is `false`.
     *
     * @return self
     */
    public function setHasWeeklyAndMonthly($has_weekly_and_monthly)
    {
        $this->container['has_weekly_and_monthly'] = $has_weekly_and_monthly;

        return $this;
    }

    /**
     * Gets pointvalue
     *
     * @return float[]|null
     */
    public function getPointvalue()
    {
        return $this->container['pointvalue'];
    }

    /**
     * Sets pointvalue
     *
     * @param float[]|null $pointvalue The currency value of a single whole unit price change in the instrument's currency. If the value is not provided it is assumed to be `1`.
     *
     * @return self
     */
    public function setPointvalue($pointvalue)
    {
        $this->container['pointvalue'] = $pointvalue;

        return $this;
    }

    /**
     * Gets expiration
     *
     * @return float[]|null
     */
    public function getExpiration()
    {
        return $this->container['expiration'];
    }

    /**
     * Sets expiration
     *
     * @param float[]|null $expiration Expiration of the futures in the following format: YYYYMMDD. Required for futures type symbols only.
     *
     * @return self
     */
    public function setExpiration($expiration)
    {
        $this->container['expiration'] = $expiration;

        return $this;
    }

    /**
     * Gets bar_source
     *
     * @return string[]|null
     */
    public function getBarSource()
    {
        return $this->container['bar_source'];
    }

    /**
     * Sets bar_source
     *
     * @param string[]|null $bar_source The principle of building bars. The default value is `trade`.
     *
     * @return self
     */
    public function setBarSource($bar_source)
    {
        $allowedValues = $this->getBarSourceAllowableValues();
        if (!is_null($bar_source) && array_diff($bar_source, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'bar_source', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['bar_source'] = $bar_source;

        return $this;
    }

    /**
     * Gets bar_transform
     *
     * @return string[]|null
     */
    public function getBarTransform()
    {
        return $this->container['bar_transform'];
    }

    /**
     * Sets bar_transform
     *
     * @param string[]|null $bar_transform The principle of bar alignment. The default value is `none`.
     *
     * @return self
     */
    public function setBarTransform($bar_transform)
    {
        $allowedValues = $this->getBarTransformAllowableValues();
        if (!is_null($bar_transform) && array_diff($bar_transform, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'bar_transform', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['bar_transform'] = $bar_transform;

        return $this;
    }

    /**
     * Gets bar_fillgaps
     *
     * @return bool[]|null
     */
    public function getBarFillgaps()
    {
        return $this->container['bar_fillgaps'];
    }

    /**
     * Sets bar_fillgaps
     *
     * @param bool[]|null $bar_fillgaps Is used to create the zero-volume bars in the absence of any trades (i.e. bars with zero volume and equal OHLC values ). The default value is `false`.
     *
     * @return self
     */
    public function setBarFillgaps($bar_fillgaps)
    {
        $this->container['bar_fillgaps'] = $bar_fillgaps;

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


