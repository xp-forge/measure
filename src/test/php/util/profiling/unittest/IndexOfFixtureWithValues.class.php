<?php namespace util\profiling\unittest;

use util\profiling\{Measure, Measurable, Values};

class IndexOfFixtureWithValues extends Measurable {

  /** @return var[][] */
  private static function fixtures() {
    return [[''], ['.'], ['a.b'], ['ab.']];
  }

  #[Measure, Values('fixtures')]
  public function strpos($fixture) {
    return false === ($p= strpos($fixture, '.')) ? -1 : $p;
  }

  #[Measure, Values('fixtures')]
  public function strcspn($fixture) {
    return strlen($fixture) === ($p= strcspn($fixture, '.')) ? -1 : $p;
  }
}