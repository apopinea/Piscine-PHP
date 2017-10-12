<?php
require_once './Vertex.class.php';
class Vector
{
    static $verbose = FALSE;
	static $doc_file_path = "./Vector.doc.txt";
    private $_x;
    private $_y;
    private $_z;
    private $_w = 0.0;
    private $_orig;

    function __construct( array $tab )
    {
        if (array_key_exists('dest', $tab) && $tab['dest'] instanceof Vertex)
        {
            $this->_x = $tab['dest']->getX();
            $this->_y = $tab['dest']->getY();
            $this->_z = $tab['dest']->getZ();            
            if (array_key_exists('orig', $tab) && $tab['orig'] instanceof Vertex)
            {
                $this->_x -= $tab['orig']->getX();
                $this->_y -= $tab['orig']->getY();
                $this->_z -= $tab['orig']->getZ();                
            }
            else
            {
                $_orig = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1 ) );
            }
        }
        else
        {
            print("error! 'dest' parameter needed\n");
            return ;
        }
        if (self::$verbose)
        {
            printf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f ) constructed\n",
                $this->getX(), $this->getY(), $this->getZ(), $this->getW());
        }
    }

    function __destruct()
    {
        if (self::$verbose)
            printf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f ) destructed\n",
        $this->getX(), $this->getY(), $this->getZ(), $this->getW());
    }

    function magnitude()
    {
        return (sqrt($this->getX() ** 2 + $this->getY() ** 2 + $this->getZ() ** 2));
    }

    function normalize()
    {
        $mag = $this->magnitude();
        if ($mag == 1.0)
            return (clone $this);
        else
        {
            return (new Vector( array('dest' => new Vertex(array( 'x' => $this->getX() / $mag,
                                                                  'y' => $this->getY() / $mag,
                                                                  'z' => $this->getZ() / $mag )))));
        }
    }

    function add(Vector $rhs)
    {
        return (new Vector( array('dest' => new Vertex(array( 'x' => $this->getX() + $rhs->getX(),
                                                              'y' => $this->getY() + $rhs->getY(),
                                                              'z' => $this->getZ() + $rhs->getZ() )))));
    }

    function sub(Vector $rhs)
    {
        return (new Vector( array('dest' => new Vertex(array( 'x' => $this->getX() - $rhs->getX(),
                                                              'y' => $this->getY() - $rhs->getY(),
                                                              'z' => $this->getZ() - $rhs->getZ() )))));
    }

    function opposite()
    {
        return (new Vector( array('dest' => new Vertex(array( 'x' => - $this->getX(),
                                                              'y' => - $this->getY(),
                                                              'z' => - $this->getZ() )))));
    }

    function scalarProduct( $k )
    {
        return (new Vector( array('dest' => new Vertex(array( 'x' => $k * $this->getX(),
                                                              'y' => $k * $this->getY(),
                                                              'z' => $k * $this->getZ() )))));
    }

    function dotProduct( Vector $rhs )
    {
        return ($this->getX() * $rhs->getX() + $this->getY() * $rhs->getY() + $this->getZ() * $rhs->getZ());
    }

    function crossProduct( Vector $rhs )
    {
        return (new Vector( array('dest' => new Vertex(array(
            'x' => $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY(),
            'y' => $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ(),
            'z' => $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX() )))));
    }

    function cos( Vector $rhs )
    {
        return ((($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z)) /
        sqrt((($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z)) *
        (($rhs->_x * $rhs->_x) + ($rhs->_y * $rhs->_y) + ($rhs->_z * $rhs->_z))));
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

    static function doc()
	{
		$fd = fopen(self::$doc_file_path, 'r');
		$text = fread($fd, filesize(self::$doc_file_path));
		return $text;
    }
    
    function __toString()
    {
        if (self::$verbose)
        {
            return vsprintf("Vector( x:%3.2f, y:%3.2f, z:%3.2f, w:%3.2f )",
            array ($this->getX(), $this->getY(), $this->getZ(), $this->getW()));
        }
    }

    public function __clone()
	{
	}
}

?>