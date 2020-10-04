<?php namespace util\profiling\unittest;

class Tracking implements \util\profiling\Run {
  public $before= [], $after= [];

  /**
   * Gets invoked with the iteration before the run
   *
   * @param  util.profiling.Iteration $iteration
   * @return var
   */
  public function before($iteration) {
    $this->before[$iteration->name()]= $iteration->times();
  }

  /**
   * Gets invoked with the iteration's result after the run
   *
   * @param  util.profiling.Result $result
   * @return var
   */
  public function after($result) {
    $this->after[$result->name()]= $result->times();
  }
}
