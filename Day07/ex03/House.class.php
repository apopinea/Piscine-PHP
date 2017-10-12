<?php

class House
{
	public function introduce()
	{
        print ("House ".static::getHouseName(). " of ".
        static::getHouseSeat() .' : "'. static::getHOuseMotto() . '"'
        . PHP_EOL);
	}
}

?>