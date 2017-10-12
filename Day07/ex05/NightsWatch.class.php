<?php

class NightsWatch
{
	public $team;

	public function recruit($name)
	{
		$this->team[] = $name;
	}

	public function fight()
	{
		foreach($this->team as $person)
		{
			if (is_subclass_of($person, "IFighter"))
			{
				$person->fight();
			}
		}
	}
}
?>
