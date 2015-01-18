<?php namespace util\profiling;

/**
 * Represents the result of an iteration over a given measurable
 *
 * @see  xp://util.profiling.Iteration
 */
class Result extends Outcome {

  /** @return bool */
  public function isException() { return false; }
}