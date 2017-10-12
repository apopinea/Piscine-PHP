<?php
class UnholyFactory
{
  private $absorbed = array(
    'foot soldier' => false,
    'llama' => false,
    'archer' => false,
    'assassin' => false,
  );
  public function absorb($soldier)
  {
    if ($soldier instanceof CrippledSoldier)
      throw new Exception("...");
    if ($soldier instanceof Fighter)
    {
      if ($this->absorbed[$soldier->type] === false)
          {
            print ("(Factory absorb a fighter of type " . $soldier->type .")".PHP_EOL);
            $this->absorbed[$soldier->type] = $soldier;
          }
        else {
          print("(already absorbed a fighter of type ". $soldier->type .")".PHP_EOL);
        }
    }
    else {
      print ("(Factory can't absorb this, it's not a fighter)");
    }
  }

  public function fabricate($soldier)
  {
    if ($this->absorbed[$soldier] !== false)
    {
      print ("(Factory fabricates a fighter of type " . $soldier . ")" . PHP_EOL);
      return clone $this->absorbed[$soldier];
    }
    else
    {
      print ("(Factory hasn't absorbed any fighter of type ". $soldier .")". PHP_EOL);
    }
  }

}

 ?>
