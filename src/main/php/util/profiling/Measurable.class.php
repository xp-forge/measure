<?php namespace util\profiling;

use lang\reflect\Method;

abstract class Measurable extends \lang\Object {
  protected $method;

  /**
   * Creates a new measurable
   *
   * @param  lang.reflect.Method $method
   */
  public function __construct(Method $method) {
    $this->method= $method;
  }

  /** @return lang.reflect.Method */
  public function method() { return $this->method; }
}