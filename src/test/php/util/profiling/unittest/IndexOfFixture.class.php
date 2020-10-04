<?php namespace util\profiling\unittest;

use util\profiling\{Measure, Measurable};

class IndexOfFixture extends Measurable {

  #[Measure]
  public function strpos() {
    return false === ($p= strpos($fixture, '.')) ? -1 : $p;
  }

  #[Measure]
  public function strcspn() {
    return strlen($fixture) === ($p= strcspn($fixture, '.')) ? -1 : $p;
  }
}