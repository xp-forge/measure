<?php namespace util\profiling\unittest;

class IndexOfFixtureWithValues extends \util\profiling\Measurable {

  /** @return var[][] */
  private static function fixtures() {
    return [[''], ['.'], ['a.b'], ['ab.']];
  }

  #[@measure, @values('fixtures')]
  public function strpos($fixture) {
    return false === ($p= strpos($fixture, '.')) ? -1 : $p;
  }

  #[@measure, @values('fixtures')]
  public function strcspn($fixture) {
    return strlen($fixture) === ($p= strcspn($fixture, '.')) ? -1 : $p;
  }
}