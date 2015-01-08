<?php

abstract class Model 
{
    protected $dbh;
	
    public function __construct() 
    {
        global $dbhost, $dbuser, $dbpass, $dbname;

        try 
        {
            $this->dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $dbpass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     		$this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        catch (PDOException $e) 
        {
            $this->dbh = null;
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }	
    }     

    public function __destruct() 
    {
        $this->dbh = null;
    }

    public function hashPassword($username, $password)
    {
        $salt = hash('sha256', uniqid(mt_rand(), true) . 'stokedplus' . strtolower($username));
        $hash = $salt . $password;

        for ( $i = 0; $i < 100000; $i ++ )
        {
            $hash = hash('sha256', $hash);
        }

        return $salt . $hash;
    }

    public function placeholders($text, $count=0, $separator=",")
    {
        $result = array();
        if($count > 0){
            for($x=0; $x<$count; $x++){
                $result[] = $text;
            }
        }

        return implode($separator, $result);
    }

    function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

    function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }
}

?>
