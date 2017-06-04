<?php namespace util\profiling;

use lang\XPClass;
use lang\IllegalArgumentException;
use util\cmd\Console;
use util\Objects;

class Measure {

  /**
   * Performs measurement
   *
   * @param  util.profiling.Measurement $m
   */
  public function run($m) {
    $m->perform(newinstance(Run::class, [], [
      'before' => function($iteration) { Console::write($iteration->name(), ': '); },
      'after'  => function($result) {
        Console::writeLinef(
          '%d iteration(s), %.3f seconds, result= %s',
          $result->iteration()->times(),
          $result->elapsed(),
          Objects::stringOf($result->result())
        );
      }
    ]));
  }

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
   * @return int
   */
  public static function main(array $args) {
    $m= new Measurement();
    for ($i= 0, $s= sizeof($args); $i < $s; $i++) {
      if ('-n' === $args[$i]) {
        $m->iterating((int)self::arg($args, ++$i, '-n'));
      } else if ('-' === $args[$i]{0} && is_numeric($args[$i])) {
        $m->iterating((int)substr($args[$i], 1));
      } else {
        $m->measuring(XPClass::forName($args[$i]));
      }
    }

    (new self())->run($m);
    return 0;
  }
}