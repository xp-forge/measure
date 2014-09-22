<?php namespace util\profiling;

use lang\FunctionType;

/**
 * Holds a measurable instance and a given number of iterations. Invoking
 * the `perform()` method produces a result.
 *
 * ```php
 * $result= (new Iteration(new Demo('strpos_impl'), 10000))->perform();
 * Console::writeLinef('Time taken: %.3f seconds', $result->elapsed());
 * ```
 */
class Iteration extends \lang\Object {
  protected static $FUNC;
  protected $measurable;
  protected $times;

  static function __static() {
    self::$FUNC= FunctionType::forName('function(?): var');
  }

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
  public function name() { return $this->measurable->method()->getName(); }

  /**
   * Performs the run and returns the result
   *
   * @return util.profiling.Result
   */
  public function perform() {
    $method= $this->measurable->method();

    $run= self::$FUNC->cast([$this->measurable, $method->getName()]);
    if ($method->hasAnnotation('values')) {
      $arg= self::$FUNC->cast([$this->measurable, $method->getAnnotation('values')]);
    } else {
      $arg= function() { };
    }

    $t= (new Timer())->start();
    for ($i= 0; $i < $this->times; $i++) {
      $result= $run($arg());
    }
    $t->stop();
    \xp::gc();

    return new Result($this, $t->elapsedTime(), $result);
  }
}