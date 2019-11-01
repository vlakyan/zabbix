#!/usr/bin/env bash

set -e

vendor/bin/php-cs-fixer fix --config=.php_cs.dist -v --using-cache=yes
vendor/bin/phpstan analyse --no-progress -c phpstan.neon -l max src tests
vendor/bin/phpmd src text phpmd.xml
vendor/bin/phpmd tests text phpmd.xml
