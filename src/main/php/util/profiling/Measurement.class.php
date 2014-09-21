<?php namespace util\profiling;

use lang\XPClass;
use util\data\Sequence;
use util\cmd\Console;
use util\Objects;
use lang\FunctionType;
use lang\IllegalArgumentException;

class Measurement extends \lang\Object {
  protected static $ANNOTATED;
  protected static $FUNC;
  protected $measurables;
  protected $times= 1;

  static function __static() {
    self::$ANNOTATED= function($m) { return $m->hasAnnotation('measure'); };
    self::$FUNC= FunctionType::forName('function(?): var');
  }

  /**
   * Add a measurable class
   *
   * @param  lang.XPClass $class
   * @return self This
   * @throws lang.IllegalArgumentException If the class is not a subclass of util.profiling.Measurable
   */
  public function measuring(XPClass $class) {
    if (!$class->isSubclassOf('util.profiling.Measurable')) {
      throw new IllegalArgumentException($class->toString().' must be a subclass of util.profiling.Measurable');
    }

    $this->measurables= Sequence::of($class->getMethods())
      ->filter(self::$ANNOTATED)
      ->map([$class, 'newInstance'])
    ;
    return $this;
  }

  /**
   * Set how many times to iterate
   *
   * @param  int $times
   * @return self This
   */
  public function iterate($times) {
    $this->times= $times;
    return $this;
  }

  /**
   * Runs this measurement
   */
  public function run() {
    $t= new Timer();
    foreach ($this->measurables as $m) {
      $method= $m->method();
      Console::write($method->getName(), ': ');

      $run= self::$FUNC->cast([$m, $method->getName()]);
      if ($method->hasAnnotation('values')) {
        $arg= self::$FUNC->cast([$m, $method->getAnnotation('values')]);
      } else {
        $arg= function() { };
      }

      $t->start();
      for ($i= 0; $i < $this->times; $i++) {
        $result= $run($arg());
      }
      $t->stop();
      Console::writeLinef('%d iteration(s), %.3f seconds, result= %s', $i, $t->elapsedTime(), Objects::stringOf($result));
      \xp::gc();
    }
  }
}