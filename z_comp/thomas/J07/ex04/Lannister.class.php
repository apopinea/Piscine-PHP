<?php
class Lannister
{
  public function sleepWith($name)
  {
      if  ($name instanceof Lannister)
        print("Not even if I'm drunk !".PHP_EOL);
      else if ($name instanceof Sansa)
        print("let's do this." . PHP_EOL);
  }
}
 ?>
