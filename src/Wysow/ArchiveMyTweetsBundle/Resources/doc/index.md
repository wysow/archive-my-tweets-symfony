Getting Started With WysowArchiveMyTweetsBundle
===============================================

## Prerequisites

This version of the bundle requires Symfony 2.3.

## Installation

Installation is a quick 4 steps process:

1. Download FOSOAuthServerBundle
2. Enable the Bundle
3. Configure your application's config.yml
4. Configure your application's routing.yml


### Step 1: Install WysowArchiveMyTweetsBundle

The preferred way to install this bundle is to rely on [Composer](http://getcomposer.org).
Just check on [Packagist](http://packagist.org/packages/wysow/archive-my-tweets-bundle) the version you want to install (in the following example, we used "dev-master") and add it to your `composer.json`:

``` js
{
    "require": {
        // ...
        "wysow/archive-my-tweets-bundle": "dev-master"
    }
}
```

### Step 2: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Wysow\ArchiveMyTweetsBundle\WysowArchiveMyTweetsBundle(),
    );
}
```

### Step 3: Configure your application's config.yml

``` yaml
# app/config/config.yml
wysow_archive_my_tweets:
    twitter:
        username: # Your username on Twitter
        name: # Your fullname (used only in templates)
        consumer_key: # the consumer key for your twitter application see [dev.twitter.com](https://dev.twitter.com)
        consumer_secret: # the consumer secret for your twitter application see [dev.twitter.com](https://dev.twitter.com)
        oauth_token: # the oauth token to connect your twitter application to your account see [dev.twitter.com](https://dev.twitter.com)
        oauth_secret: # the oauth secret to connect your twitter application to your account see [dev.twitter.com](https://dev.twitter.com)
    gravatar:
        email: # your gravatar email to show your image in templates
```

### Step 4: Configure your application's routing.yml

``` yaml
# app/config/routing.yml
wysow_archive_my_tweets:
    resource: "@WysowArchiveMyTweetsBundle/Controller/"
    type:     annotation
    prefix:   # the prefix you want to use to reach this bundle's controllers
```