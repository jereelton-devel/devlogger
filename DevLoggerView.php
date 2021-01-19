<?php

class DevLoggerView
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

        return $this->DevLoggerView();
    }

    private function DevLoggerView()
    {
        if($this->auth == false){
            return false;
        }

        $filepath = "./log/{$this->logname}.log";

        $getfile = file_get_contents($filepath);

        if($getfile == false) {
            return false;
        }

        return $getfile;
    }
}

?>
