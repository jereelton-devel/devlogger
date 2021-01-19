<?php

class DevLoggerList
{
    private $auth;

    public function __construct($auth)
    {
        $this->auth = false;
        if($auth == true) {
            $this->auth = true;
        }
    }

    public function devLogger()
    {
        return $this->DevLoggerView();
    }

    private function DevLoggerView()
    {
        if($this->auth == false){
            return false;
        }

        $filepath = "./log/";
        $getfiles = [];
        $listfiles = glob($filepath."*.log", GLOB_BRACE);

        if(count($listfiles) == 0) {
            return false;
        } else {

            foreach ($listfiles as $logfile) {
                $getfiles[] = str_replace(".log", "", basename($logfile));
            }

            return json_encode(["logfiles"=>$getfiles]);
        }
    }
}

?>
