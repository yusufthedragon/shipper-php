# Shipper API PHP Client

Unofficial library for access [Shipper](http://shipper.id) API from applications written with PHP.

- [Installation](#installation)
- [Usage](#usage)
  - [Set the API Key](#set-the-api-key)
  - [Set the Production Mode](#set-the-production-mode)
- [Available Methods and Examples](#available-methods-and-examples)
  - [Locations](#locations)
    - [Get Countries](#get-countries)
    - [Get Provinces](#get-provinces)
    - [Get Cities](#get-cities)
    - [Get Origin Cities](#get-origin-cities)
    - [Get Suburbs](#get-suburbs)
    - [Get Areas](#get-areas)
    - [Search Location](#search-location)
  - [Rates](#rates)
    - [Get Domestic Rates](#get-domestic-rates)
    - [Get International Rates](#get-international-rates)
  - [Orders](#orders)
    - [Create Domestic Order](#create-domestic-order)
    - [Create International Order](#create-international-order)
    - [Get Tracking ID](#get-tracking-id)
    - [Activate Order](#activate-order)
    - [Get Order Detail](#get-order-detail)
    - [Update Order](#update-order)
    - [Cancel Order](#cancel-order)
  - [Pickup Orders](#pickup-orders)
    - [Create Pickup Request](#create-pickup-request)
    - [Cancel Pickup Request](#cancel-pickup-request)
    - [Get Agents by Suburb](#get-agents-by-suburb)
  - [Furthermore](#furthermore)
    - [Get All Tracking Status](#get-all-tracking-status)
    - [Generate AWB Number](#generate-awb-number)
- [Exceptions](#exceptions)
  - [ArgumentCountError](#argumentcounterror)
  - [InvalidArgumentException](#invalidargumentexception)
  - [ClientException](#clientexception)
- [Contributing](#contributing)

---

## Installation

Install shipper-php with composer by following command:

```bash
composer require yusufthedragon/shipper-php
```

or add it manually in your `composer.json` file.

## Usage

### Set the API Key

Configure package with your account's api key obtained from Shipper.

```php
Shipper::setApiKey('apiKey');
```

### Set the Production Mode

When deploying your application to production, you may want to change API Endpoint as well by setting `setProductionMode` to `true`.

```php
Shipper::setProductionMode(true);
// or chain it with setApiKey method
Shipper::setProductionMode(true)->setApiKey('apiKey');
```

## Available Methods and Examples

### Locations

#### Get Countries

Retrieve country data in a list.

```php
\Shipper\Location::getCountries();
```

Usage example:

```php
$getCountries = \Shipper\Location::getCountries();
var_dump($getCountries);
```

#### Get Provinces

Retrieve all provinces in Indonesia in a list.

```php
\Shipper\Location::getProvinces();
```

Usage example:

```php
$getProvinces = \Shipper\Location::getProvinces();
var_dump($getProvinces);
```

#### Get Cities

Retrieve cities based on submitted province ID.

```php
\Shipper\Location::getCities(int $provinceId);
```

Usage example:

```php
$getCities = \Shipper\Location::getCities(9);
var_dump($getCities);
```

#### Get Origin Cities

Retrieve provinces in which Shipper provides pickup service.

```php
\Shipper\Location::getOriginCities();
```

Usage example:

```php
$getOriginCities = \Shipper\Location::getOriginCities();
var_dump($getOriginCities);
```

#### Get Suburbs

Retrieve suburbs based on submitted city ID.

```php
\Shipper\Location::getSuburbs(int $cityId);
```

Usage example:

```php
$getSuburbs = \Shipper\Location::getSuburbs(80);
var_dump($getSuburbs);
```

#### Get Areas

Retrieve areas based on submitted suburb ID.

```php
\Shipper\Location::getAreas(int $suburbId);
```

Usage example:

```php
$getAreas = \Shipper\Location::getAreas(1330);
var_dump($getAreas);
```

#### Search Location

Retrieve every area, suburb, and city whose names include the submitted substring (including postcode).

```php
\Shipper\Location::searchLocation(string $substring);
```

Usage example:

```php
$searchLocation = \Shipper\Location::searchLocation('jakarta');
var_dump($searchLocation);
```

### Rates

#### Get Domestic Rates

```php
\Shipper\Rates::getDomesticRates(array $parameters);
```

Usage example:

```php
$parameters = [
    'o' => 4802,
    'd' => 4852,
    'l' => 20,
    'w' => 15,
    'h' => 10,
    'wt' => 1.0,
    'v' => 199000,
    'type' => 1,
    'cod' => 0,
    'order' => 0,
    'originCoord' => '-6.1575362903,106.7858796692',
    'destinationCoord' => '-6.17846396594961,106.84122923291011​'
];

$getDomesticRates = \Shipper\Rates::getDomesticRates($parameters);
var_dump($getDomesticRates);
```

#### Get International Rates

```php
\Shipper\Rates::getInternationalRates(array $parameters);
```

Usage example:

```php
$parameters = [
    'o' => 4802,
    'd' => 180,
    'l' => 20,
    'w' => 15,
    'h' => 10,
    'wt' => 1.0,
    'v' => 199000,
    'type' => 2,
    'order' => 0
];

$getInternationalRates = \Shipper\Rates::getInternationalRates($parameters);
var_dump($getInternationalRates);
```

### Orders

#### Create Domestic Order

```php
\Shipper\Order::createDomesticOrder(array $parameters);
```

Usage example:

```php
$parameters = [
    'o' => 4828,
    'd' => 4833,
    'l' => 10,
    'w' => 10,
    'h' => 10,
    'wt' => 1,
    'v' => 100000,
    'rateID' => 49,
    'consigneeName' => 'Peoorang',
    'consigneePhoneNumber' => '089899878987',
    'consignerName' => 'Peorang',
    'consignerPhoneNumber' => '089891891818',
    'originAddress' => 'Mangga Dua Selatan',
    'originDirection' => '',
    'destinationAddress' => 'Pasar Baru',
    'destinationDirection' => '',
    'itemName' => [
        [
            'name' => 'Baju',
            'qty' => 1,
            'value' => 100000
        ]
    ],
    'contents' => 'Merah',
    'useInsurance' => 0,
    'packageType' => 2,
    'paymentType' => 'cash',
    'externalID' => '',
    'cod' => 0
];

$createDomesticOrder = \Shipper\Order::createDomesticOrder($parameters);
var_dump($createDomesticOrder);
```

#### Create International Order

```php
\Shipper\Order::createInternationalOrder(array $parameters);
```

Usage example:

```php
$parameters = [
    'o' => 4802,
    'd' => 180,
    'l' => 10,
    'w' => 10,
    'h' => 10,
    'wt' => 1,
    'v' => 100000,
    'rateID' => 210,
    'consigneeName' => 'Peoorang',
    'consigneePhoneNumber' => '089899878987',
    'consignerName' => 'Peorang',
    'consignerPhoneNumber' => '089891891818',
    'originAddress' => 'Mangga Dua Selatan',
    'originDirection' => '',
    'destinationAddress' => 'Orchard Road 101',
    'destinationDirection' => '',
    'destinationArea' => 'Singapore',
    'destinationSuburb' => 'Singapore',
    'destinationCity' => 'Singapore',
    'destinationProvince' => 'Singapore',
    'destinationPostcode' => '111111',
    'itemName' => [
        [
            'name' => 'Baju',
            'qty' => 1,
            'value' => 100000
        ]
    ],
    'contents' => 'Merah',
    'useInsurance' => 0,
    'packageType' => 2,
    'paymentType' => 'cash',
    'externalID' => '',
    'cod' => 0
];

$createInternationalOrder = \Shipper\Order::createInternationalOrder($parameters);
var_dump($createInternationalOrder);
```

#### Get Tracking ID

Retrieve tracking ID of the order with the provided ID.

```php
\Shipper\Order::getTrackingID(string $orderId);
```

Usage example:

```php
$getTrackingID = \Shipper\Order::getTrackingID('5f259130a172cf001222f533');
var_dump($getTrackingID);
```

#### Activate Order

Activate/Deactivate an order. Such activation will initiate Shipper's pickup process.

```php
\Shipper\Order::activateOrder(string $orderId, array $parameters);
```

Usage example:

```php
$parameters = [
    'active' => 1
];

$activateOrder = \Shipper\Order::activateOrder('5f259130a172cf001222f533', $parameters);
var_dump($activateOrder);
```

#### Get Order Detail

Retrieve an order's detail. Date format is UTC time.

```php
\Shipper\Order::getOrderDetail(string $orderId);
```

Usage example:

```php
$getOrderDetail = \Shipper\Order::getOrderDetail('5f259130a172cf001222f533');
var_dump($getOrderDetail);
```

#### Update Order

Update an order's package's weight and dimension.

```php
\Shipper\Order::updateOrder(string $orderId, array $parameters);
```

Usage example:

```php
$parameters = [
    'l' => 1,
    'w' => 1,
    'h' => 1,
    'wt' => 1
];

$updateOrder = \Shipper\Order::updateOrder('5f259130a172cf001222f533', $parameters);
var_dump($updateOrder);
```

#### Cancel Order

Cancel an order.

```php
\Shipper\Order::cancelOrder(string $orderId);
```

Usage example:

```php
$cancelOrder = \Shipper\Order::cancelOrder('5f259130a172cf001222f533');
var_dump($cancelOrder);
```

### Pickup Orders

#### Create Pickup Request

Assign agent and activate orders.

```php
\Shipper\Pickup::createPickup(array $parameters);
```

Usage examples

```php
$parameters = [
    'orderIds' => ['5e45538'],
    'agentId' => 1432,
    'datePickup' => '2020-08-11 10:30:00'
];

$createPickup = \Shipper\Pickup::createPickup($parameters);
var_dump($createPickup);
```

#### Cancel Pickup Request

Cancel pickup request.

```php
\Shipper\Pickup::cancelPickup(array $parameters);
```

Usage example:

```php
$parameters = [
    'orderIds' => ['5e45538'],
];

$cancelPickup = \Shipper\Pickup::cancelPickup($parameters);
var_dump($cancelPickup);
```

#### Get Agents by Suburb

Get agent by origin suburb ID.

```php
\Shipper\Pickup::getAgents(int $suburbId);
```

Usage example:

```php
$getAgents = \Shipper\Pickup::getAgents(1330);
var_dump($getAgents);
```

### Furthermore

#### Get All Tracking Status

```php
\Shipper\Tracking::getAllStatus();
```

Usage example:

```php
$getAllStatus = \Shipper\Tracking::getAllStatus();
var_dump($getAllStatus);
```

##### Generate AWB Number

Generate AWB from related logistic, in case that AWB number in order is not generated yet when order sent.

```php
\Shipper\AWB::generate(array $parameters);
```

```php
$parameters = [
    'oid' => '5f259130a172cf001222f533'
];

$generate = \Shipper\AWB::generate($parameters);
var_dump($generate);
```

## Exceptions

### ArgumentCountError

`ArgumentCountError` will be thrown if too few arguments are passed to a function or method.

For example, argument `cityId` must be passed to function `getCities`. If user does not provide one, `ArgumentCountError` will be thrown.

### InvalidArgumentException

`InvalidArgumentException` will be thrown if the argument provided by user is not sufficient to create the request, or if an argument is not of the excepted type.

For example, there are required arguments such as `l`, `w`, `h`, and `wt` to update an order. If user lacks one or more arguments when attempting to create one, or if one or more arguments are not `integer` nor `float`, `InvalidArgumentException` will be thrown.

### ClientException

`ClientException` will be thrown if a client error is encountered (4xx codes) when send request to API.

For example, if order is not found when create a pickup request, `ClientException` will be thrown.

## Contributing

For any requests, bugs, or comments, please open an [issue](https://github.com/yusufthedragon/shipper-php/issues) or [submit a pull request](https://github.com/yusufthedragon/shipper-php/pulls).
