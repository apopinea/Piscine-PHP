<?php

class Jaime extends Lannister
{
  public function sleepWith($name)
  {
    if ($name instanceof Sansa)
      print("let's do this." . PHP_EOL);
    else if ($name instanceof Tyrion)
      print("Not even if I'm drunk !".PHP_EOL);
    else if ($name instanceof Cersei)
      print("with pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
  }
}

 ?>
