<?php namespace util\profiling\unittest;

use lang\{IllegalArgumentException, XPClass};
use unittest\{BeforeClass, Expect, Test, Values};
use util\profiling\Measurement;

class MeasurementTest extends \unittest\TestCase {
  protected static $measurable;

  #[BeforeClass]
  public static function defineMeasurable() {
    self::$measurable= XPClass::forName('util.profiling.unittest.IndexOfFixture');
  }

  #[Test]
  public function can_create() {
    new Measurement();
  }

  #[Test, Expect(IllegalArgumentException::class), Values([0, -1])]
  public function iterating_less_than_once($times) {
    $m= new Measurement();
    $m->iterating($times);
  }

  #[Test]
  public function iterating_returns_this() {
    $m= new Measurement();
    $this->assertEquals($m, $m->iterating(100000));
  }

  #[Test]
  public function measuring_returns_this() {
    $m= new Measurement();
    $this->assertEquals($m, $m->measuring(self::$measurable));
  }

  #[Test, Expect('lang.IllegalArgumentException')]
  public function measuring_raises_exception_when_class_is_not_measurable() {
    (new Measurement())->measuring(typeof($this));
  }

  #[Test, Values([1, 2])]
  public function perform_given_a_run_instance_invokes_before_for_all_methods($times) {
    $r= [];
    (new Measurement())->measuring(self::$measurable)->iterating($times)->perform(newinstance('util.profiling.Run', [], [
      'before' => function($iteration) use(&$r) { $r[$iteration->name()]= $iteration->times(); },
      'after'  => function($result) { /* Intentionally empty */ }
    ]));
    $this->assertEquals(['strpos' => $times, 'strcspn' => $times], $r);
  }

  #[Test, Values([1, 2])]
  public function perform_given_a_run_instance_invokes_after_for_all_methods($times) {
    $r= [];
    (new Measurement())->measuring(self::$measurable)->iterating($times)->perform(newinstance('util.profiling.Run', [], [
      'before' => function($iteration) { /* Intentionally empty */ },
      'after'  => function($result) use(&$r) { $r[$result->name()]= $result->times(); },
    ]));
    $this->assertEquals(['strpos' => $times, 'strcspn' => $times], $r);
  }
}