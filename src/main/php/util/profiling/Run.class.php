<?php namespace util\profiling;

interface Run {

  /**
   * Gets invoked with the iteration before the run
   *
   * @param  util.profiling.Iteration $iteration
   * @return void
   */
  public function before($iteration);

  /**
   * Gets invoked with the iteration's result after the run
   *
   * @param  util.profiling.Result $result
   * @return void
   */
  public function after($result);
}