<?php namespace util\profiling;

/**
 * Represents the result of an iteration over a given measurable
 *
 * @see  xp://util.profiling.iteration
 */
class Result extends \lang\Object {
  protected $iteration;
  protected $elapsed;
  protected $result;

  /**
   * Creates a new result instance
   *
   * @param  util.profiling.Iteration $iteration
   * @param  double $elapsed
   * @param  var $result
   */
  public function __construct(Iteration $iteration, $elapsed, $result) {
    $this->iteration= $iteration;
    $this->elapsed= $elapsed;
    $this->result= $result;
  }

  /** @return util.profiling.Iteration */
  public function iteration() { return $this->iteration; }

  /** @return double */
  public function elapsed() { return $this->elapsed; }

  /** @return var */
  public function result() { return $this->result; }

  /** @return int */
  public function times() { return $this->iteration->times(); }

  /** @return string */
  public function name() { return $this->iteration->name(); }
}