<?php namespace util\profiling\unittest;

use util\profiling\Measurement;
use util\profiling\Iteration;
use lang\XPClass;

class MeasurementTest extends \unittest\TestCase {
  protected static $measurable;

  #[@beforeClass]
  public static function defineMeasurable() {
    self::$measurable= XPClass::forName('util.profiling.unittest.IndexOfFixture');
  }

  #[@test]
  public function can_create() {
    new Measurement();
  }

  #[@test]
  public function iterating_returns_this() {
    $m= new Measurement();
    $this->assertEquals($m, $m->iterating(100000));
  }

  #[@test]
  public function measuring_returns_this() {
    $m= new Measurement();
    $this->assertEquals($m, $m->measuring(self::$measurable));
  }

  #[@test, @expect('lang.IllegalArgumentException')]
  public function measuring_raises_exception_when_class_is_not_measurable() {
    (new Measurement())->measuring($this->getClass());
  }

  #[@test]
  public function perform_given_a_run_instance_invokes_before_for_all_methods() {
    $iterations= [];
    (new Measurement())->measuring(self::$measurable)->iterating(1)->perform(newinstance('util.profiling.Run', [], [
      'before' => function($iteration) use(&$iterations) { $iterations[]= $iteration; },
      'after'  => function($result) { /* Intentionally empty */ }
    ]));
    $this->assertEquals(
      [new Iteration(self::$measurable->newInstance('strpos'), 1), new Iteration(self::$measurable->newInstance('strcspn'), 1)],
      $iterations
    );
  }
}