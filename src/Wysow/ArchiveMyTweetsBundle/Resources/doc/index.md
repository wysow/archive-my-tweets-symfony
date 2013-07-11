Getting Started With WysowArchiveMyTweetsBundle
===============================================

## Prerequisites

This version of the bundle requires Symfony 2.3.

## Installation

Installation is a quick 4 steps process:

1. Install WysowArchiveMyTweetsBundle
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

## Setting up a cron job

If you want to automatically update your tweets you'll need to set up a cron job. You can find more information on Cron elsewhere, but here's an example that will run your cron.php every hour of the day:

    0 * * * * /usr/bin/env php /path/to/the/app/console wysow:twitter:archive [--with-favorites]

The `with-favorites` option is to import your own tweets + the tweets you have favorited.

## Importing Your Official Twitter Archive

If you started using Archive My Tweets after you already had 3200 tweets, then you're in luck. It's now possible to import your older tweets from your downloaded twitter archive.

Twitter now allows most accounts (they're still rolling this out) to download an official archive of all your tweets from the beginning of time. This is great news, and especially amazing is the JavaScript app they've included with it to browse and search your tweets.

To import the archive follow these steps:

1. Visit your Twitter account settings: [https://twitter.com/settings/account](https://twitter.com/settings/account)
2. Near the bottom of the settings page there should be a button to download your archive. (If you don't see it yet, you may have to wait until it's rolled out to all accounts.)
3. Once you've downloaded and unzipped your archive, copy all of the .js files in the `app/Ressources/tweets` folder.
4. Run the command `php /path/to/the/app/console wysow:twitter:archive --from-import=/path/to/the/app/Ressources/tweets` to import all your tweets in database

You'll only have to do this one time, as the cron running regularly will import all your newest tweets. Tweets that are already in your database will be ignored, so don't worry about duplication.

