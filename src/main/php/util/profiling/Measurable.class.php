<?php namespace util\profiling;

use lang\XPException;
use lang\reflect\Method;
use util\Objects;

abstract class Measurable {
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
      $this->method= typeof($this)->getMethod($method);
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
      return $this->method->getName().'('.implode(', ', array_map([Objects::class, 'stringOf'], $this->arguments)).')';
    } else {
      return $this->method->getName();
    }
  }
}