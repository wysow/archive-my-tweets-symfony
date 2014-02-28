#!/bin/bash
PHP=php

echo 'Install assets in the web folder'
$PHP app/console --env=prod assets:install web

echo 'Update the database schema'
$PHP app/console doctrine:schema:update --force

echo 'Clear the cache of the production environment.'
$PHP app/console cache:clear --env=prod