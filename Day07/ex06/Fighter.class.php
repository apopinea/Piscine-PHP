<?php

abstract class Fighter
{
	public $soldiertype;

	public function __construct($var)
	{
		$this->soldiertype = $var;
	}

	abstract public function fight($target);

	public function getname()
	{
		return ($this->soldiertype);
	}
}

?>
