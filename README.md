
# Sociomile Digital API Connector

3rd party package for creating Ticket & Check Status Ticket3rd party package for creating Ticket & Check Status Ticket


## Installation

```bash
composer require kopigreenx/sociomile-digital-pkg

php artisan migrate
```


## Features

- Create Ticket As Agent
- Create Ticket As Customer
- Check Status Ticket


## Function Reference

#### Create Ticket As Agent

```php
  SociomileDigital::createTicketAsAgent($internal_id,$phone,$name,$message)
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `$internal_id` | `string` | **Required**. Internal ID |
| `$phone` | `string` | **Required**. Contact Number  |
| `$name` | `string` | **Required**. Contact Name  |
| `$message` | `string` | **Required**. Message Will be sent  |

#### Create Ticket As Customer

```php
  SociomileDigital::createTicketAsCustomer($internal_id,$phone,$name,$message)
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `$internal_id` | `string` | **Required**. Internal ID |
| `$phone` | `string` | **Required**. Contact Number  |
| `$name` | `string` | **Required**. Contact Name  |
| `$message` | `string` | **Required**. Message Will be sent  |

#### Check Status Ticket

```php
  SociomileDigital::statusTicket($phone)
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `$phone` | `string` | **Required**. Contact Number  |




## Environment Variables

```sh
SOCIOMILE_DIGITAL_HOST = <HOST>
SOCIOMILE_DIGITAL_SECRET = <SECRET_KEY>
SOCIOMILE_DIGITAL_ID = <SECRET_ID>
SOCIOMILE_DIGITAL_WABA_ID = <WABA_ID>
SOCIOMILE_DIGITAL_WABA_TYPE = <TYPE>
SOCIOMILE_DIGITAL_WABA_SECRET=<WABA_SECRET>
```

