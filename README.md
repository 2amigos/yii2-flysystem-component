# Flysystem Component Wrappers for Yii 2 

[![Latest Version](https://img.shields.io/github/release/2amigos/yii2-flysystem-component.svg?style=flat-square)](https://github.com/2amigos/yii2-flysystem-component/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/2amigos/yii2-flysystem-component/master.svg?style=flat-square)](https://travis-ci.org/2amigos/yii2-flysystem-component)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/2amigos/yii2-flysystem-component.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-flysystem-component/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/2amigos/yii2-flysystem-component.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-flysystem-component)
[![Total Downloads](https://img.shields.io/packagist/dt/2amigos/yii2-flysystem-component.svg?style=flat-square)](https://packagist.org/packages/2amigos/yii2-flysystem-component)


> [Flysystem](http://flysystem.thephpleague.com/) is a file system abstraction which allows you to easily swap out a 
  local filesystem for a remote one. 

This component library provides components that expose the [Flysystem](http://flysystem.thephpleague.com/) API to your 
Yii 2 applications. The following are the currently supported ones: 
 
 - [AwsS3FsComponent](#AwsS3FsComponent): Interacts with Amazon S3 buckets. 
 - [AzureFsComponent](#AzureFsComponent): Interfaces with Microsoft Azure.
 - [DropboxFsComponent](#DropboxFsComponent): Interacts with Dropbox.
 - [FtpFsComponent](#FtpFsComponent): Interacts with an FTP server.
 - [GoogleCloudFsComponent](#GoogleCloudFsComponent): Interacts with Google Cloud Storage. 
 - [GridFSFsComponent](#GridFSFsComponent): Interacts with GridFS.
 - [LocalFsComponent](#LocalFsComponent): Interacts with your local server storage.
 - [MemoryFsComponent](#MemoryFsComponent): Interacts with memory. Useful when you don't want anything persisted.
 - [NullFsComponent](#NullFsComponent): Used for testing.
 - [RackspaceFsComponent](#RackspaceFsComponent): Interacts with Rackspace.
 - [SftpFsComponent](#SftpFsComponent): Interacts with an Sftp server.
 - [WebDAVFsComponent](#WebDAVFsComponent): Interacts with WebDAV.
 - [ZipArchiveFsComponent](#ZipArchiveFsComponent): Interacts with zip archives.

## Install

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require 2amigos/yii2-flysystem-component
```

or add

```
"2amigos/yii2-flysystem-component": "^1.0"
```

to the `require` section of your `composer.json` file.

## Usage

### AwsS3FsComponent 

Install dependency 

```bash
$ composer require league/flysystem-aws-s3-v3
```

Configure on the application `components` section:

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\AwsS3FsComponent',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'bucket' => 'your-bucket',
            'region' => 'your-region',
            // 'version' => 'latest',
            // 'baseUrl' => 'your-base-url',
            // 'prefix' => 'your-prefix',
            // 'options' => [],
        ],
    ],
];
```

When you application run, you will be able to use the component as: 

```php
Yii::$app->fs->read(....);
```

Check [http://flysystem.thephpleague.com/api/](http://flysystem.thephpleague.com/api/) for all the methods available. 
Same methods for all adapters.

### AzureFsComponent 

First ensure the pear repository is added to your `composer.json` file: 

``` 
"repositories": [
    {
        "type": "pear",
        "url": "http://pear.php.net"
    }
],
```

Then install the latest version of the plugin

```bash
$ composer require league/flysystem-azure
```

Configure on the application `components` section:

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\AzureFsComponent',
            'accountName' => 'your-account-name',
            'accountKey' => 'your-account-key',
            'container' => 'your-container',
        ],
    ],
];
```
### DropboxFsComponent 

Install dependency 

```bash
$ composer require league/flysystem-dropbox
```

Configure on the application `components` section:

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\DropboxFsComponent',
            'token' => 'your-token',
            'app' => 'your-app',
            // 'prefix' => 'your-prefix',
        ],
    ],
];
```

### FtpFsComponent 

Configure application `components` as follows

```php
return [
    //...
    'components' => [
        //...
        'ftpFs' => [
            'class' => 'dosamigos\flysystem\FtpFsComponent',
            'host' => 'ftp.example.com',
            // 'port' => 21,
            // 'username' => 'your-username',
            // 'password' => 'your-password',
            // 'ssl' => true,
            // 'timeout' => 60,
            // 'root' => '/path/to/root',
            // 'permPrivate' => 0700,
            // 'permPublic' => 0744,
            // 'passive' => false,
            // 'transferMode' => FTP_TEXT,
        ],
    ],
];
```

### GoogleCloudFsComponent

Install dependency 

```bash
$ composer require cedricziel/flysystem-gcs
```

Configure on the application `components` section:

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\GoogleCloudFsComponent',
            'projectId' => 'your-project-id',
            'bucket' => 'your-bucket',
            // 'prefix' => 'your-prefix',
        ],
    ],
];
```

### GridFSFsComponent 

Install dependency 

```bash
$ composer require league/flysystem-gridfs
```

Configure on the application `components` section:

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\GridFSFsComponent',
            'server' => 'mongodb://localhost:27017',
            'database' => 'your-database',
        ],
    ],
];
```

### LocalFsComponent 

Configure application `components` as follows

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\LocalFsComponent',
            'path' => '@webroot/your-writable-folder-to-save-files',
        ],
    ],
];
```
### MemoryFsComponent 

Install dependency 

```bash
$ composer require league/flysystem-memory
```

Configure application `components` as follows

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\MemoryFsComponent',
        ],
    ],
];
```

### NullFsComponent 

Configure application `components` as follows

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\NullFsComponent',
        ],
    ],
];
```

### RackspaceFsComponent 

Install dependency 

```bash
$ composer require league/flysystem-rackspace
```

Configure application `components` as follows

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\RackspaceFsComponent',
            'endpoint' => 'your-endpoint',
            'region' => 'your-region',
            'username' => 'your-username',
            'apiKey' => 'your-api-key',
            'container' => 'your-container',
            // 'prefix' => 'your-prefix',
        ],
    ],
];
```

### SftpFsComponent 

Install dependency 

```bash
$ composer require league/flysystem-sftp
```

Configure application `components` as follows

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\SftpFsComponent',
            'host' => 'sftp.example.com',
            'username' => 'your-username',
            'password' => 'your-password',
            'privateKey' => '/path/to/or/contents/of/privatekey',
            // 'port' => 22,
            // 'timeout' => 60,
            // 'root' => '/path/to/root',
            // 'permPrivate' => 0700,
            // 'permPublic' => 0744,
        ],
    ],
];
```

### WebDAVFsComponent 

Install dependency 

```bash
$ composer require league/flysystem-webdav
```

Configure application `components` as follows

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\WebDAVFsComponent',
            'baseUri' => 'your-base-uri',
            // 'userName' => 'your-user-name',
            // 'password' => 'your-password',
            // 'proxy' => 'your-proxy',
            // 'authType' => \Sabre\DAV\Client::AUTH_BASIC,
            // 'encoding' => \Sabre\DAV\Client::ENCODING_IDENTITY,
            // 'prefix' => 'your-prefix',
        ],
    ],
];
```

### ZipArchiveFsComponent 

Install dependency 

```bash
$ composer require league/flysystem-ziparchive
```

Configure application `components` as follows

```php
return [
    //...
    'components' => [
        //...
        'fs' => [
            'class' => 'dosamigos\flysystem\ZipArchiveFsComponent',
            'path' => '@webroot/files/archive.zip',
            // 'prefix' => 'your-prefix',
        ],
    ],
];
```

## Cool Stuff 

### Multiple Instances 

You can configure as many components as you need. Simply add them to the `components` section with different names. For 
example, I could have S3 and FTP at the same time: 

```php 
return [
    //...
    'components' => [
        //...
        's3Fs' => [
            'class' => 'dosamigos\flysystem\AwsS3FsComponent',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'bucket' => 'your-bucket',
            'region' => 'your-region',
            // 'version' => 'latest',
            // 'baseUrl' => 'your-base-url',
            // 'prefix' => 'your-prefix',
            // 'options' => [],
        ],
        'ftpFs => [
            'class' => 'dosamigos\flysystem\FtpFsComponent',
            'host' => 'ftp.example.com',
        ]
    ],
];
```

Now, I could use them like `Yii::$app->s3Fs` and `Yii::$app->ftpFs` respectively.

### Caching 

If you wish to add caching functionality, first we need to include the dependencies on your `composer.json` file: 

```bash
$ composer require league/flysystem-cached-adapter
```

Next, configure the following attributes on your adapter:
 
```php
return [
 //...
 'components' => [
     //...
     'fs' => [
         //...
         'cache' => 'cacheID',
         // 'cacheKey' => 'my-cache-key',
         // 'cacheDuration' => 7200,
     ],
 ],
];
```

### Replicating

The replication facilitates transitions between adapters, allowing an application to stay functional and migrate its 
files from one adapter to another. The adapter takes two other adapters, a source and a replica. Every change is 
delegated to both adapters, while all the read operations are passed onto the source only.

To use the replication feature first install its dependencies: 

```bash
$ composer require league/flysystem-replicate-adapter
```

Next, configure as follows:
 
```php
return [
    //...
    'components' => [
        //...
        's3Fs' => [
            'class' => 'dosamigos\flysystem\AwsS3FsComponent',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'bucket' => 'your-bucket',
            'region' => 'your-region',
        ],
        'ftpFs => [
            'class' => 'dosamigos\flysystem\FtpFsComponent',
            'host' => 'ftp.example.com',
            'replica' => 's3Fs' // we have added the ID of the replica component
        ]
    ],
];
```

## Further Information 

- [API](API.md)
- [Flysystem](http://flysystem.thephpleague.com/)

## Testing

```bash
$ phpunit
```

## Using code fixer

We have added a PHP code fixer to standardize our code. It includes Symfony, PSR2 and some contributors rules. 

```bash 
./vendor/bin/php-cs-fixer fix ./src --config .php_cs
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits 

- [crecoder](https://github.com/creocoder) for the original idea of flysystem wrappers
- [2amigos](https://github.com/2amigos)
- [All Contributors](../../contributors)

## License

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.

<blockquote>
    <a href="http://www.2amigos.us"><img src="http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png"></a><br>
    <i>Custom Software | Web & Mobile Software Development</i><br>
    <a href="http://www.2amigos.us">www.2amigos.us</a>
</blockquote>
