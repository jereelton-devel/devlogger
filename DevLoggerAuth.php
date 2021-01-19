<?php

require_once("./DevLogger.php");

class DevLoggerAuth
{
    private $headers;
    private $objDevLogger;

    public function __construct()
    {
        $this->headers = apache_request_headers();
        return $this->devLoggerAuthorization();
    }

    private function devLoggerAuthorization()
    {
        $this->objDevLogger = new DevLogger(true);

        if (
            (isset($this->headers['Host']) && $this->headers['Host'] == "[DOMAIN]")
            &&
            (!isset($this->headers['Origin']) || $this->headers['Origin'] != "https://[DOMAIN]")
            ||
            (!isset($this->headers['Referer']) || !strstr($this->headers['Referer'], "https://[DOMAIN]"))
        )
        {
            $errorlogger = print_r($this->headers, true);

            $this->objDevLogger->devLogger('[Acesso Negado]','acesso');
            $this->objDevLogger->devLogger($errorlogger, 'acesso');

            echo base64_encode("<h5>Acesso Negado</h5>");
            return false;
        }

        if (
            (!isset($this->headers['Origin']) || $this->headers['Origin'] != "https://[DOMAIN]")
            ||
            (!isset($this->headers['Referer']) || !strstr($this->headers['Referer'], "https://[DOMAIN]"))
        ) {
            $errorlogger = print_r($this->headers, true);

            $this->objDevLogger->devLogger('[Acesso Negado]','acesso');
            $this->objDevLogger->devLogger($errorlogger, 'acesso');

            echo base64_encode("<h5>Acesso Negado</h5>");
            return false;
        }

        return true;
    }
}

?>