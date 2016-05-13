# Shariff Symfony 2 Bundle

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/eda75d3b-c628-40d5-9033-55aaee034895/mini.png)](https://insight.sensiolabs.com/projects/eda75d3b-c628-40d5-9033-55aaee034895)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cedricziel/ShariffBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cedricziel/ShariffBundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/cedricziel/ShariffBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/cedricziel/ShariffBundle/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/cedricziel/ShariffBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/cedricziel/ShariffBundle/build-status/master)

Forked from https://github.com/valiton/ShariffBundle

This bundle allows to easily integrate [Shariff](https://github.com/heiseonline/shariff-backend-php) with your Symfony 2 application

Installation
------------

Install the bundle with composer:

```
composer require cedricziel/shariff-bundle
```

and activate the bundle in your kernel.

Add the following to your app/config/routing.yml:

```
cedricziel_shariff:
    resource: "@CedricZielShariffBundle/Resources/config/routing.xml"
    prefix:   /_shariff
```

Configuration
-------------

Configure the bundle according to your needs, full config example:

```
cedricziel_shariff:
    domain: '<your-domain>' 
    force_protocol: ~ # http or https
    cache:
        cacheDir: '%kernel.cache_dir%'   
        ttl: 3600
        adapter: 'Apc' # to use apc for caching, 
    client: # optinal guzzle settings
        timeout: 4
        connect_timeout: 2
    services:
        Facebook:
            app_id: <your app id>
            secret: <your secret>
        GooglePlus: ~
        Twitter: ~
```

# License

MIT
