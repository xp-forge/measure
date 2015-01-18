<?php namespace util\profiling;

use lang\reflect\Method;
use lang\XPException;

abstract class Measurable extends \lang\Object {
  private $method, $arguments;

  /**
   * Creates a new measurable
   *
   * @param  var $method Either a lang.reflect.Method or a string
   * @param  var[] $args
   */
  public function __construct($method, $arguments= []) {
    if ($method instanceof Method) {
      $this->method= $method;
    } else {
      $this->method= $this->getClass()->getMethod($method);
    }
    $this->arguments= $arguments;
  }

  /** @return lang.reflect.Method */
  public final function method() { return $this->method; }

  /** @return var[] */
  public final function arguments() { return $this->arguments; }

  /**
   * Returns name consisting of method and variation
   *
   * @return string
   */
  public final function compoundName() {
    if ($this->arguments) {
      return $this->method->getName().'('.implode(', ', array_map('xp::stringOf', $this->arguments)).')';
    } else {
      return $this->method->getName();
    }
  }

  /**
   * Returns whether a given value is equal to this 
   *
   * @param  var $cmp
   * @return bool
   */
  public final function equals($cmp) {
    return $cmp instanceof self && $this->method->equals($cmp->method);
  }
}