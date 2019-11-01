#!/usr/bin/env bash

set -e

php -dzend_extension=xdebug.so -dxdebug.coverage_enable=1 vendor/phpunit/phpunit/phpunit -c phpunit.xml.dist --coverage-text --colors=never
