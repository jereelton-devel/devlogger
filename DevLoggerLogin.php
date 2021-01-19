<?php

require_once("./DevLogger.php");

class DevLoggerLogin
{
    private $name;
    private $pass;

    public function __construct($name, $pass)
    {
        $this->name = $name;
        $this->pass = $pass;
    }

    public function devLoggerLogin()
    {
        /*AMBIENTE DEVEL: usuário e senha padrão*/
        if(base64_decode($this->name) == "devel" && md5(base64_decode($this->pass)) == "329e179205ab5e347a80c6a878bcdcb9") {
            return true;
        }

        return false;
    }
}

?>