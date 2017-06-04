<?php namespace util\profiling;

/** @deprecated - use xp.measure.Runner instead */
class Measure {

  /** @return int */
  public static function main(array $args) {
    return \xp\measure\Runner::main($args);
  }
}