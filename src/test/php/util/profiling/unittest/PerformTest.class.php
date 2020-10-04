<?php namespace util\profiling\unittest;

use unittest\{Test, Values};
use util\profiling\Measurement;

class PerformTest extends \unittest\TestCase {

  #[Test, Values([1, 2])]
  public function before($times) {
    $tracking= (new Measurement())
      ->measuring('util.profiling.unittest.IndexOfFixture')
      ->iterating($times)
      ->perform(new Tracking())
    ;

    $this->assertEquals(['strpos' => $times, 'strcspn' => $times], $tracking->before);
  }

  #[Test, Values([1, 2])]
  public function after($times) {
    $tracking= (new Measurement())
      ->measuring('util.profiling.unittest.IndexOfFixture')
      ->iterating($times)
      ->perform(new Tracking())
    ;

    $this->assertEquals(['strpos' => $times, 'strcspn' => $times], $tracking->after);
  }

  #[Test, Values([1, 2])]
  public function permutation($times) {
    $tracking= (new Measurement())
      ->measuring('util.profiling.unittest.IndexOfFixtureWithValues')
      ->iterating($times)
      ->perform(new Tracking())
    ;

    $this->assertEquals(
      [
        'strpos("")'     => $times, 
        'strpos(".")'    => $times, 
        'strpos("a.b")'  => $times,
        'strpos("ab.")'  => $times,
        'strcspn("")'    => $times,
        'strcspn(".")'   => $times,
        'strcspn("a.b")' => $times,
        'strcspn("ab.")' => $times
      ],
      $tracking->before
    );
  }
}