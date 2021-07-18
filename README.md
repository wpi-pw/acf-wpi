# [Advanced Custom Fields wpi](https://acf.wpi.pw)
[![Packagist](https://img.shields.io/packagist/vpre/wpi-pw/acf-wpi.svg?style=flat-square)](https://packagist.org/packages/wpi-pw/acf-wpi)
[![devDependency Status](https://img.shields.io/david/dev/wpi-pw/acf-wpi.svg?style=flat-square)](https://david-dm.org/wpi-pw/acf-wpi#info=devDependencies)
[![Build Status](https://img.shields.io/travis/wpi-pw/acf-wpi.svg?style=flat-square)](https://travis-ci.com/wpi-pw/acf-wpi)

=== Advanced Custom Fields wpi ===

A custom ACF plugin boilerplate.

== Setup ==

This plugin uses namespaces following format:
CompanyName\PluginName\Folder 

It starts with namespace ACF\ACFWPI autoloading the lib folder;

Before composer install -> do a find and replace in all folders for ACFWPI.  Replace with your plugin name.

== Commands ==

To Bootstrap:

1. composer install
2. npm i
3. npm run watch


All Commands:
```shell
composer install
composer dump-autoload
npm i
npm run watch
npm run dev # prod for production
```
