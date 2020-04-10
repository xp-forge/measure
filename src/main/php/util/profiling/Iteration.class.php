<?php namespace util\profiling;

use lang\{FunctionType, IllegalStateException, Throwable};

/**
 * Holds a measurable instance and a given number of iterations. Invoking
 * the `perform()` method produces a result.
 *
 * ```php
 * $result= (new Iteration(new Demo('strpos_impl'), 10000))->perform();
 * Console::writeLinef('Time taken: %.3f seconds', $result->elapsed());
 * ```
 */
class Iteration {
  protected $measurable;
  protected $times;

  /**
   * Creates a new run instance
   *
   * @param  util.profiling.Measurable $measurable
   * @param  int $times
   */
  public function __construct(Measurable $measurable, $times) {
    $this->measurable= $measurable;
    $this->times= $times;
  }

  /** @return util.profiling.Measureable */
  public function measurable() { return $this->measurable; }

  /** @return int */
  public function times() { return $this->times; }

  /** @return string */
  public function name() { return $this->measurable->compoundName(); }

  /**
   * Performs the run and returns the result
   *
   * @return util.profiling.Outcome
   */
  public function perform() {
    $reflect= $this->measurable->method()->_reflect;
    $arguments= $this->measurable->arguments();

    \xp::gc();
    $t= (new Timer())->start();
    try {
      for ($i= 0; $i < $this->times; $i++) {
        $result= $reflect->invokeArgs($this->measurable, $arguments);
      }
      return new Result($this, $t->elapsedTime(), $result);
    } catch (Throwable $e) {
      return new Exception($this, $t->elapsedTime(), $e);
    } catch (\Throwable $e) { // PHP7
      return new Exception($this, $t->elapsedTime(), new IllegalStateException($e->getMessage()));
    } catch (\Exception $e) { // PHP5
      return new Exception($this, $t->elapsedTime(), new IllegalStateException($e->getMessage()));
    }
  }
}