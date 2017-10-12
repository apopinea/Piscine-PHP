<?php

class UnholyFactory
{
	public $lst;

	private function _absorbed($val)
	{
		foreach($this->lst as $member)
		{
			if (get_class($member) == $val)
				return True;
		}
		return False;
	}

	public function absorb($person)
	{
        if (get_class($person) === "Footsoldier" ||
            get_class($person) === "Archer" || get_class($person) === "Assassin")
		{
			if ($this->_absorbed(get_class($person)))
			{
				print("(Factory already absorbed a fighter of type ".$person->getname().")\n");
			}
			else
			{
				print("(Factory absorbed a fighter of type ".$person->getname().")\n");
				$this->lst[] = $person;
			}
		}
		else
			print("(Factory can't absorb this, it's not a fighter)\n");
	}

	private function _fabricate($nom)
	{
		foreach($this->lst as $member)
		{
			if ($member->getname() == $nom)
			{
				return $member;
			}
		}
		return False;
	}

	public function fabricate($nom)
	{
		if ($member = $this->_fabricate($nom))
		{
			print("(Factory fabricates a fighter of type ".$nom. PHP_EOL);
			return $member;
		}
		else
			print("(Factory hasn't absorbed any fighter of type ".$nom. PHP_EOL);
	}
}

?>
