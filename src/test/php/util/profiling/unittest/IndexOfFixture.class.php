<?php namespace util\profiling\unittest;

class IndexOfFixture extends \util\profiling\Measurable {

  #[@measure]
  public function strpos() {
    return strpos('abc.', '.');
  }

  #[@measure]
  public function strcspn() {
    return strcspn('abc.', '.');
  }
}