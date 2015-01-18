<?php namespace util\profiling;

interface Run {

  /**
   * Gets invoked with the iteration before the run
   *
   * @param  util.profiling.Iteration $iteration
   * @return var
   */
  public function before($iteration);

  /**
   * Gets invoked with the iteration's result after the run
   *
   * @param  util.profiling.Result $result
   * @return var
   */
  public function after($result);
}