<?php
require_once './Color.class.php';
class Vertex
{
    static $verbose = FALSE;
	static $doc_file_path = "./Vertex.doc.txt";
    private $_x;
    private $_y;
    private $_z;
    private $_w;
    private $_color;

    function __construct( array $tab)
    {
        if (array_key_exists('x', $tab) && 
            array_key_exists('y', $tab) &&
            array_key_exists('z', $tab))
        {
            $this->setX($tab['x']);
            $this->setY($tab['y']);
            $this->setZ($tab['z']);
            if (array_key_exists('w', $tab))
            {
                $this->setW($tab['w']);
            }
            else
                $this->setW(1.0);
            if (array_key_exists('color', $tab))
            {
                $this->_color = clone $tab['color'];
            }
            else
                $this->_color = new Color(array( 'rgb' => 0xFFFFFF ));
        }
        if (self::$verbose)
            printf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed\n",
        $this->getX(), $this->getY(), $this->getZ(), $this->getW(),
        $this->getColor()->red, $this->getColor()->green,
        $this->getColor()->blue);          
    }

    function __destruct()
    {
        if (self::$verbose)
            printf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed\n",
        $this->getX(), $this->getY(), $this->getZ(), $this->getW(),
        $this->getColor()->red, $this->getColor()->green,
        $this->getColor()->blue);
    }

    public function getX()
    {
        return ($this->_x);
    }
    public function getY()
    {
        return ($this->_y);
    }
    public function getZ()
    {
        return ($this->_z);
    }
    public function getW()
    {
        return ($this->_w);
    }
    public function getColor()
    {
        return ($this->_color);
    }
    public function setX($val)
    {
        $this->_x = $val;
    }
    public function setY($val)
    {
        $this->_y = $val;
    }
    public function setZ($val)
    {
        $this->_z = $val;
    }
    public function setW($val)
    {
        $this->_w = $val;
    }
    public function setColor( Color $rgb)
    {
        $this->_color->red = $rgb->red;
        $this->_color->green = $rgb->green;
        $this->_color->blue = $rgb->blue;
    }

    function __toString()
    {
        if (!(self::$verbose))
        {
            return vsprintf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f )", array (
                $this->getX(), $this->getY(), $this->getZ(), $this->getW()));
        }
        else
        {
            return vsprintf("Vertex( x: %3.2f, y: %3.2f, z:%3.2f, w:%3.2f, Color( red: %3d, green: %3d, blue: %3d ) )", array (
                $this->getX(), $this->getY(), $this->getZ(), $this->getW(),
                $this->getColor()->red, $this->getColor()->green,
                $this->getColor()->blue));
        }
    }
    
    static function doc()
	{
		$fd = fopen(self::$doc_file_path, 'r');
		$text = fread($fd, filesize(self::$doc_file_path));
		return $text;
	}
}

?>