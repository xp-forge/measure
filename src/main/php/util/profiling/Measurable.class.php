<?php namespace util\profiling;

use lang\reflect\Method;

abstract class Measurable extends \lang\Object {
  protected $method;

  /**
   * Creates a new measurable
   *
   * @param  var $method Either a lang.reflect.Method or a string
   */
  public function __construct($method) {
    if ($method instanceof Method) {
      $this->method= $method;
    } else {
      $this->method= $this->getClass()->getMethod($method);
    }
  }

  /** @return lang.reflect.Method */
  public final function method() { return $this->method; }
}