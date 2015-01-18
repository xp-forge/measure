<?php namespace util\profiling\unittest;

class IndexOfFixture extends \util\profiling\Measurable {

  #[@measure]
  public function strpos() {
    return false === ($p= strpos($fixture, '.')) ? -1 : $p;
  }

  #[@measure]
  public function strcspn() {
    return strlen($fixture) === ($p= strcspn($fixture, '.')) ? -1 : $p;
  }
}