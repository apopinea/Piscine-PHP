<?php

class Color{

	public $red = 0;
	public $green = 0;
	public $blue = 0;
	static $verbose = FALSE;
	static $doc_file_path = "./Color.doc.txt";
	
	public function __construct( array $kwargs)
	{
		if (array_key_exists('rgb', $kwargs))
		{
			$rgb = intval($kwargs['rgb']);
			$this->red = ($rgb >> 16) & 0xFF;
			$this->green = ($rgb >> 8) & 0xFF;
			$this->blue = $rgb & 0xFF;
		}
		else
		{
			$this->red = intval($kwargs['red']) & 0xFF;
			$this->green = intval($kwargs['green']) & 0xFF;
			$this->blue = intval($kwargs['blue']) & 0xFF;
		}
		if (self::$verbose)
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n",
				$this->red, $this->green, $this->blue);
		return ; 
	}

	public function add(Color $t)
	{
		$ret = new Color( array( 'red' => ($this->red + $t->red),
				'green' => ($this->green + $t->green),
				'blue' => ($this->blue + $t->blue) ));
		return ($ret);
	}

	public function sub(Color $t)
	{
		$ret = new Color( array( 'red' => ($this->red - $t->red),
			'green' => ($this->green - $t->green),
			'blue' => ($this->blue - $t->blue) ));
		return ($ret);
	}

	public function mult( $nb )
	{
		$ret =  new Color( array( 'red' => ($this->red * $nb),
		'green' => ($this->green * $nb),
		'blue' => ($this->blue  * $nb) ));
	return ($ret);
	}

	function __toString()
	{
		return vsprintf("Color( red: %3d, green: %3d, blue: %3d )",
			array($this->red, $this->green, $this->blue));
	}

	function __destruct()
	{
		if (self::$verbose)
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n",
				$this->red, $this->green, $this->blue);
		return ;
	}

	static function doc()
	{
		$fd = fopen(self::$doc_file_path, 'r');
		$text = fread($fd, filesize(self::$doc_file_path));
		return $text;
	}

	public function __clone()
	{
		if (self::$verbose)
			printf("Clone : Color( red: %3d, green: %3d, blue: %3d ) destructed.\n",
				$this->red, $this->green, $this->blue);
	}
}

?>