
# Sociomile Digital API Connector

3rd party package for creating Ticket & Check Status Ticket3rd party package for creating Ticket & Check Status Ticket


## Installation

```php
composer require kopigreenx/whatspie-pkg
```
### Registering Provider Class
    directory  config/app.php
```php
'providers' => [
    Kopigreenx\Whatspie\WhatspieServiceProvider::class
]

```


## Features

- send Text Message
- send Image Message
- send File Message


## Function Reference
#### Init

```php
    new Whatspie($device,$secret_key,$uri)
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| $device | `string` | **Required**. Device Number |
| $secret_key | `string` | **Required**. Secret Key |
| $uri | `string` | **Required**. API URL |
#### Create Ticket As Agent

```php
  Whatspie::sendTextMessage($receiver,$message)
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `$receiver` | `string` | **Required**. Contact Number  |
| `$message` | `string` | **Required**. Message Will be sent  |

#### Create Ticket As Customer

```php
  Whatspie::sendImageMessage($receiver,$message,$file_url)
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `$receiver` | `string` | **Required**. Contact Number  |
| `$message` | `string` | **Required**. Message Will be sent  |
| `$file_url` | `string` | **Required**. Image Url  |

#### Check Status Ticket

```php
  Whatspie::sendFileMessage($receiver,$message,$file_url)
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `$receiver` | `string` | **Required**. Contact Number  |
| `$message` | `string` | **Required**. Message Will be sent  |
| `$file_url` | `string` | **Required**. File Url  |

