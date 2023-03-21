#!/bin/bash
php bin/console d:m:m --no-interaction
php bin/console doctrine:fixtures:load --no-interaction
exec apache2-foreground