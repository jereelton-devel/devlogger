<?php

class DevLogger
{
    private $logdata;
    private $logname;
    private $auth;
    private $dateCurrent;
    private $dateLogfile;

    public function __construct($auth)
    {
        date_default_timezone_set("America/Sao_Paulo");
        $this->dateCurrent = date('d/m/Y H:i:s', time());
        $this->dateLogfile = date('dmY');

        $this->auth = false;
        if($auth == true) {
            $this->auth = true;
        }
    }

    public function devLogger($logdata, $logname)
    {
        $this->logdata = $logdata;
        $this->logname = $logname."_".$this->dateLogfile;

        return $this->devLoggerWrite();
    }

    private function devLoggerWrite()
    {
        if($this->auth == false){
            return false;
        }

        $filepath = "./log/{$this->logname}.log";
        $this->logdata = base64_decode($this->logdata);

        if (strstr($this->logdata, "[Start]") == true) {
            $this->logdata = PHP_EOL . $this->dateCurrent . " " . $this->logdata . PHP_EOL;
        } else {
            $this->logdata = $this->dateCurrent . " " . $this->logdata . PHP_EOL;
        }

        if (file_put_contents($filepath, $this->logdata, FILE_APPEND)) {
            return true;
        }

        return false;
    }
}

?>
