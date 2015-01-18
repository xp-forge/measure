<?php namespace util\profiling;

use lang\XPClass;
use util\data\Sequence;
use lang\IllegalArgumentException;

/**
 * A measurement suite
 *
 * ```php
 * $m= (new Measurement())->measuring($class)->iterating(100000);
 * $m->perform(newinstance('util.profiling.Run', [], [
 *   'before' => function($iteration) { Console::write($iteration->name(), ': '); },
 *   'after'  => function($result) { Console::writeLinef('%.3f seconds', $result->elapsed()); }
 * ]));
 * ```
 *
 * @test xp://util.profiling.unittest.MeasurementTest
 */
class Measurement extends \lang\Object {
  protected static $ANNOTATED;
  protected $measurables;
  protected $times= 1;

  static function __static() {
    self::$ANNOTATED= function($m) { return $m->hasAnnotation('measure'); };
  }

  /**
   * Add a measurable class
   *
   * @param  lang.XPClass $class
   * @return self This
   * @throws lang.IllegalArgumentException If the class is not a subclass of util.profiling.Measurable
   */
  public function measuring(XPClass $class) {
    if (!$class->isSubclassOf('util.profiling.Measurable')) {
      throw new IllegalArgumentException($class->toString().' must be a subclass of util.profiling.Measurable');
    }

    $this->measurables= Sequence::of($class->getMethods())
      ->filter(self::$ANNOTATED)
      ->map([$class, 'newInstance'])
    ;
    return $this;
  }

  /**
   * Set how many times to iterate
   *
   * @param  int $times
   * @return self This
   * @throws lang.IllegalArgumentException If times is less than 1
   */
  public function iterating($times) {
    if ($times < 1) {
      throw new IllegalArgumentException('Given amount must be at least 1, have '.$times);
    }
    $this->times= $times;
    return $this;
  }

  /**
   * Performs the measurement
   *
   * @param  util.profiling.Run $run Run these before and after
   * @return void
   */
  public function perform(Run $run) {
    $this->measurables
      ->map(function($m) { return new Iteration($m, $this->times); })
      ->peek([$run, 'before'])
      ->map(function($iteration) { return $iteration->perform(); })
      ->peek([$run, 'after'])
      ->each(function() { })
    ;
  }
}