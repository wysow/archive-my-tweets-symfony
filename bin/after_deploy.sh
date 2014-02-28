#!/bin/bash
PHP=php

echo 'Update the database schema'
$PHP app/console doctrine:schema:update --force

echo 'Clear the cache of the production environment.'
$PHP app/console cache:clear --env=prod