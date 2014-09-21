<?php namespace util\profiling\unittest;

use util\profiling\Measurement;

class MeasurementTest extends \unittest\TestCase {

  #[@test]
  public function can_create() {
    new Measurement();
  }
}