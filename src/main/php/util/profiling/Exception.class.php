<?php namespace util\profiling;

/**
 * Represents an iteration of a given measurable raised an exception
 *
 * @see  xp://util.profiling.Iteration
 */
class Exception extends Outcome {

  /** @return bool */
  public function isException() { return false; }
}