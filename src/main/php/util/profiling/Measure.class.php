<?php namespace util\profiling;

use lang\XPClass;
use lang\IllegalArgumentException;

class Measure extends \lang\Object {

  /**
   * Returns a given argument
   *
   * @param  string[] $args The source
   * @param  int $i The offset
   * @param  string $arg The name
   * @return string
   * @throws lang.IllegalArgumentException
   */
  protected static function arg($args, $i, $arg) {
    if (!isset($args[$i])) {
      throw new IllegalArgumentException('Missing argument for '.$arg);
    }
    return $args[$i];
  }

  /**
   * Main entry point
   *
   * @param  string[] $args
   * @return void
   */
  public static function main(array $args) {
    $m= new Measurement();
    for ($i= 0, $s= sizeof($args); $i < $s; $i++) {
      if ('-n' === $args[$i]) {
        $m->iterate((int)self::arg($args, ++$i, '-n'));
      } else {
        $m->measuring(XPClass::forName($args[$i]));
      }
    }
    $m->run();
  }
}