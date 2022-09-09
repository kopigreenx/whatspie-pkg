# Sociomile Digital API Connector
## 3rd party package for creating Ticket & Check Status Ticket

## Installation

```sh
composer require kopigreenx/sociomile-digital-pkg

php artisan migrate

```

## Function

add anywhere you want run 
```sh
use Kopigreenx\SociomileDigital\SociomileDigital;
```

| function |Required| Description | Status|
| ------ | ------ | ------ | ------ |
| SociomileDigital::createTicket | internal_id,user_id,phone,name,message | Creating ticket to sociomile | Active|
| SociomileDigital::statusTicket | user_id | Check sociomile ticket status | Inactive |

## IMPORTANT ADD TO Environment File
SOCIOMILE_DIGITAL_HOST = <HOST>
SOCIOMILE_DIGITAL_SECRET = <SECRET_KEY>
SOCIOMILE_DIGITAL_ID = <SECRET_ID>

