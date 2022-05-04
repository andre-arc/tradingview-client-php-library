# # SymbolInfoResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**s** | **string** | Status will always be &#x60;ok&#x60;. |
**symbol** | **string[]** | This is the name of the symbol - a string that the users will see. It should contain uppercase letters, numbers, a dot or an underscore. Also, it will be used for data requests if you are not using tickers. |
**description** | **string[]** | Description of a symbol. Will be displayed in the chart legend for this symbol. |
**currency** | **string[]** | Symbol currency, also named as counter currency. If a symbol is a currency pair, then the currency field has to contain the second currency of this pair. For example, &#x60;USD&#x60; is a currency for &#x60;EURUSD&#x60; ticker. Fiat currency must meet the ISO 4217 standard. |
**base_currency** | **string[]** | For currency pairs only. This field contains the first currency of the pair. For example, base currency for &#x60;EURUSD&#x60; ticker is &#x60;EUR&#x60;. Fiat currency must meet the ISO 4217 standard. | [optional]
**exchange_listed** | **string[]** | Short name of exchange where this symbol is listed. |
**exchange_traded** | **string[]** | Short name of exchange where this symbol is traded. |
**minmovement** | **float[]** | Minimal integer price change. |
**minmovement2** | **float[]** | This is a number for complex price formatting cases. The default value is &#x60;0&#x60;. | [optional]
**fractional** | **bool[]** | Boolean showing whether this symbol wants to have complex price formatting (see &#x60;minmov2&#x60;) or not. The default value is &#x60;false&#x60;. | [optional]
**pricescale** | **float[]** | Indicates how many decimal points the price has. For example, if the price has 2 decimal points (ex., 300.01), then &#x60;pricescale&#x60; is &#x60;100&#x60;. If it has 3 decimals, then &#x60;pricescale&#x60; is &#x60;1000&#x60; etc. If the price doesn&#39;t have decimals, set &#x60;pricescale&#x60; to &#x60;1&#x60;. |
**root** | **string[]** | Root of the features. It&#39;s required for futures symbol types only. Provide a null value for other symbol types. | [optional]
**root_description** | **string[]** | Short description of the futures root that will be displayed in the symbol search. It&#39;s required for futures only. Provide a null value for other symbol types. | [optional]
**has_intraday** | **bool[]** | Boolean value showing whether the symbol includes intraday (minutes) historical data. If it&#39;s &#x60;false&#x60; then all buttons for intraday resolutions will be disabled for this particular symbol. If it is set to &#x60;true&#x60;, all resolutions that are supplied directly by the datafeed must be provided in &#x60;intraday-multipliers&#x60; array. The default value is &#x60;true&#x60;. | [optional]
**has_no_volume** | **bool[]** | Boolean showing whether the symbol includes volume data or not. The default value is &#x60;false&#x60;. | [optional]
**type** | [**\OpenAPI\Client\Model\SymbolType[]**](SymbolType.md) | Symbol type (forex/stock etc.). |
**is_cfd** | **bool[]** | Boolean value showing whether the symbol is CFD. The base instrument type is set using the type field. | [optional]
**ticker** | **string[]** | This is a unique identifier for this particular symbol in your symbology. If you specify this property then its value will be used for all data requests for this symbol. | [optional]
**timezone** | **string[]** | Timezone of the exchange for this symbol. We expect to get the name of the time zone in olsondb format. |
**session_regular** | **string[]** | Session time format is HHMM-HHMM. E.g., a session that starts at 9:30 am and ends at 4:00 pm should look like &#x60;0930-1600&#x60;. There is a special case for symbols traded 24/7 (e.g., Bitcoin and other cryptocurrencies): the session string should be &#x60;24x7&#x60;. To specify an overnight session set start time greater than end time (ie, &#x60;1700-0900&#x60;). Session time is expected to be in exchange time zone. |
**session_extended** | **string[]** | An extended session, includes &#x60;session-premarket&#x60; and &#x60;session-postmarket&#x60;. The start time should be earlier or be equal to the start time of the &#x60;session-regular&#x60; and be equal to the start time of the &#x60;session-premarket&#x60; if it exists. | [optional]
**session_premarket** | **string[]** | An additional session before &#x60;session-regular&#x60;. The start time should be equal to the start time of the &#x60;session-extended&#x60;. The end time should be equal or less than the start time of the &#x60;session-regular&#x60;. | [optional]
**session_postmarket** | **string[]** | An additional session after the &#x60;session-regular&#x60;. The start time should be equal or greater than the end time of the &#x60;session-regular&#x60;. The end time should be equal to the end time of the &#x60;session-extended&#x60;. | [optional]
**supported_resolutions** | **string[][]** | An array of resolutions which should be enabled in resolutions picker for this symbol. Each item of an array is expected to be a string. | [optional]
**has_daily** | **bool[]** | The boolean value showing whether data feed has its own daily resolution bars or not. If &#x60;has-daily&#x60; &#x3D; &#x60;false&#x60; then Charting Library will build the respective resolutions using 1-minute bars by itself. If not, then it will request those bars from the data feed. The default value is &#x60;true&#x60;. | [optional]
**intraday_multipliers** | **string[][]** | This is an array containing intraday resolutions (in minutes) that the data feed may provide. E.g., if the data feed supports resolutions such as &#x60;[\&quot;1\&quot;, \&quot;5\&quot;, \&quot;15\&quot;]&#x60;, but has 1-minute bars for some symbols then you should set &#x60;intraday-multipliers&#x60; of this symbol to &#x60;[1]&#x60;. This will make Charting Library build 5 and 15-minute resolutions by itself. | [optional]
**has_weekly_and_monthly** | **bool[]** | The boolean value showing whether data feed has its own weekly and monthly resolution bars or not. If &#x60;has-weekly-and-monthly&#x60; &#x3D; &#x60;false&#x60; then Charting Library will build the respective resolutions using daily bars by itself. If not, then it will request those bars from the data feed. The default value is &#x60;false&#x60;. | [optional]
**pointvalue** | **float[]** | The currency value of a single whole unit price change in the instrument&#39;s currency. If the value is not provided it is assumed to be &#x60;1&#x60;. | [optional]
**expiration** | **float[]** | Expiration of the futures in the following format: YYYYMMDD. Required for futures type symbols only. | [optional]
**bar_source** | **string[]** | The principle of building bars. The default value is &#x60;trade&#x60;. | [optional]
**bar_transform** | **string[]** | The principle of bar alignment. The default value is &#x60;none&#x60;. | [optional]
**bar_fillgaps** | **bool[]** | Is used to create the zero-volume bars in the absence of any trades (i.e. bars with zero volume and equal OHLC values ). The default value is &#x60;false&#x60;. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
