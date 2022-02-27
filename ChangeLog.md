Measuring API change log
========================

## ?.?.? / ????-??-??

## 3.0.1 / 2022-02-27

* Made compatible with XP 11 and `xp-forge/sequence` version 10.0.0
  (@thekid)

## 3.0.0 / 2020-04-10

* Made it possible to supply either a class name or a class *file* name
  as argument to `xp measure`
  (@thekid)
* Implemented xp-framework/rfc#334: Drop PHP 5.6:
  . **Heads up:** Minimum required PHP version now is PHP 7.0.0
  . Rewrote code base, grouping use statements
  . Converted `newinstance` to anonymous classes
  (@thekid)

## 2.0.1 / 2020-01-07

* Added compatibility with XP 10 - @thekid

## 2.0.0 / 2017-06-04

* Implemented `measure` subcommand - see PR #3 - @thekid
* **Heads up:** Dropped PHP 5.5 support - @thekid
* Added forward compatibility with XP 9.0.0 - @thekid

## 1.1.0 / 2017-04-12

* Added version compatibility with XP 8 - @thekid

## 1.0.0 / 2016-02-21

* Added version compatibility with XP 7 - @thekid
* **Heads up**: Changed minimum XP version to XP 6.5.0, and with it the
  minimum PHP version to PHP 5.5.
  (@thekid)

## 0.4.0 / 2015-06-14

* Added forward compatibility with PHP7 - @thekid
* Changed dependency on xp-forge/sequence to ^2.2.1 - @thekid

## 0.3.0 / 2015-02-12

* Changed dependency to use XP 6.0 (instead of dev-master) - @thekid
* Added support for `@values` annotation which can produce permutations
  to be used for parametrized measurements. Supports arrays or references
  to static class methods of measurable class.
  (@thekid)
* Catch exceptions from methods and report them in outcome - @thekid

## 0.2.0 / 2015-01-10

* Made available via Composer - @thekid

## 0.1.0 / 2014-09-23

* First public release - @thekid
