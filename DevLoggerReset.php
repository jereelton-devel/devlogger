<?php

class DevLoggerReset
{
    private $logname;
    private $auth;

    public function __construct($auth)
    {
        $this->auth = false;
        if($auth == true) {
            $this->auth = true;
        }
    }

    public function devLogger($logname)
    {
        $this->logname = $logname;

        return $this->DevLoggerReset();
    }

    private function DevLoggerReset()
    {
        if($this->auth == false){
            return false;
        }

        $filepath = "./log/{$this->logname}.log";

        if (file_put_contents($filepath, '')) {
            return true;
        }

        return false;
    }
}

?>

