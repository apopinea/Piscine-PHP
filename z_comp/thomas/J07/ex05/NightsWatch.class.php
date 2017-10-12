<?php
class NightsWatch
{
	public $fighters = array();
	public function fight()
	{
		foreach ($this->fighters as $soldier)
		{
			if (method_exists($soldier, 'fight'))
				$soldier->fight();
		}
	}
	public function recruit($guy)
	{
		$this->fighters[] = $guy;
	}
}
?>
