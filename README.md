Measure
=======

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/measure.svg)](http://travis-ci.org/xp-forge/measure)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.4+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_4plus.png)](http://php.net/)
[![Latest Stable Version](https://poser.pugx.org/xp-forge/measure/version.png)](https://packagist.org/packages/xp-forge/measure)

Measuring performance of different implementations in an xUnit-style way.

Examples
--------

```php
class Demo extends \util\profiling\Measurable {
  
  #[@measure]
  public function strpos() {
    return strpos('abc.', '.');
  }

  #[@measure]
  public function strcspn() {
    return strcspn('abc.', '.');
  }
}
```

Running:

```sh
$ xp util.profiling.Measure Demo -n 1000000
strpos: 1000000 iteration(s), 0.352 seconds, result= 3
strcspn: 1000000 iteration(s), 0.361 seconds, result= 3
```