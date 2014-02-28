#!/bin/bash
PHP=php

echo 'Copy the distributed YAML parameters to the required parameters.yml.'
cp app/config/parameters.yml.pagoda app/config/parameters.yml

echo 'Download the composer.phar file, so the vendors can be installed from the distributed composer.json.'
if [ ! -f composer.phar ]
    then
        curl -s -O http://getcomposer.org/composer.phar
fi

echo 'Install the needed vendors for this application.'
$PHP composer.phar install --prefer-source --no-progress --no-dev

echo 'Dump the optimized autoloader classmap for performance reasons.'
$PHP composer.phar dump-autoload --optimize