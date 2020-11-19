Measure
=======

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/measure.svg)](http://travis-ci.org/xp-forge/measure)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Requires PHP 7.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_0plus.png)](http://php.net/)
[![Latest Stable Version](https://poser.pugx.org/xp-forge/measure/version.png)](https://packagist.org/packages/xp-forge/measure)

Measuring performance of different implementations in an xUnit-style way.

Example
-------

```php
use util\profiling\{Measure, Measurable};

class Iteration extends Measurable {
  
  #[Measure]
  public function strpos() {
    return false === ($p= strpos('abc.', '.')) ? -1 : $p;
  }

  #[Measure]
  public function strcspn() {
    return 4 === ($p= strcspn('abc.', '.')) ? -1 : $p;
  }
}
```

Running:

```sh
$ xp measure -1000000 Demo
strpos: 1000000 iteration(s), 0.308 seconds, result= 3
strcspn: 1000000 iteration(s), 0.350 seconds, result= 3
```

Permutation
-----------

```php
use util\profiling\{Measure, Measurable, Values};

class Demo extends Measurable {

  #[Measure, Values(['', '.', '.a', 'a.', 'a.b'])]
  public function strpos($fixture) {
    return false === ($p= strpos($fixture, '.')) ? -1 : $p;
  }

  #[Measure, Values(['', '.', '.a', 'a.', 'a.b'])]
  public function strcspn($fixture) {
    return strlen($fixture) === ($p= strcspn($fixture, '.')) ? -1 : $p;
  }
}
```

Running:

```sh
$ xp measure -1000000 Demo
strpos(""): 1000000 iteration(s), 0.534 seconds, result= -1
strpos("."): 1000000 iteration(s), 0.527 seconds, result= 0
strpos(".a"): 1000000 iteration(s), 0.523 seconds, result= 0
strpos("a."): 1000000 iteration(s), 0.531 seconds, result= 1
strpos("a.b"): 1000000 iteration(s), 0.541 seconds, result= 1
strcspn(""): 1000000 iteration(s), 0.633 seconds, result= -1
strcspn("."): 1000000 iteration(s), 0.617 seconds, result= 0
strcspn(".a"): 1000000 iteration(s), 0.622 seconds, result= 0
strcspn("a."): 1000000 iteration(s), 0.605 seconds, result= 1
strcspn("a.b"): 1000000 iteration(s), 0.613 seconds, result= 1
```