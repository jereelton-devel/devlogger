<?php

session_start();

header("Access-Control-Allow-Origin: *");

/*error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);*/

require_once("./DevLoggerAuth.php");

extract($_REQUEST);

if($acao == 'createlog') {

    require_once("./DevLogger.php");

    $oAuth = new DevLoggerAuth();
    $oDevLogger = new DevLogger($oAuth);

    $resp = 'Houve um erro ao tentar inserir no log ' . $logname . '.log';
    if($oDevLogger->devLogger($logdata, $logname) == true) {
        $resp = 'Log atualizado com sucesso';
    }

    echo base64_encode($resp);
    exit;
}

if($acao == 'viewlog') {

    require_once("./DevLoggerView.php");

    $oAuth = new DevLoggerAuth();
    $oDevLoggerView = new DevLoggerView($oAuth);
    $response = $oDevLoggerView->devLogger($logname);

    $resp = 'Houve um erro ao tentar ler o log ' . $logname . '.log';
    if($response != false) {
        $resp = preg_replace('/^[\n]$/i','<br />', $response);
    }

    echo base64_encode($resp);
    exit;
}

if($acao == 'resetlog') {

    require_once("./DevLoggerReset.php");

    $oAuth = new DevLoggerAuth();
    $oDevLoggerReset = new DevLoggerReset($oAuth);

    $resp = 'Houve um erro ao tentar resetar o log ' . $logname . '.log';
    if($oDevLoggerReset->devLogger($logname) == true) {
        $resp = 'Log resetado com sucesso';
    }

    echo base64_encode($resp);
    exit;

}

if($acao == 'listlog') {

    require_once("./DevLoggerList.php");

    $oAuth = new DevLoggerAuth();
    $oDevLoggerList = new DevLoggerList($oAuth);
    $response = $oDevLoggerList->devLogger();

    $resp = 'Houve um erro ao tentar listar os logs';
    if($response != false) {
        $resp = $response;
    }

    echo base64_encode($resp);
    exit;

}

if($acao == 'auth') {

    require_once("./DevLoggerLogin.php");

    //devel, 123mudar$
    $oLogin = new DevLoggerLogin($name, $pass);

    $resp = 'Erro';
    if($oLogin->devLoggerLogin()) {
        $resp = 1;
        $_SESSION['loggerlogin'] = $name;
    }

    echo base64_encode($resp);
    exit;

}

echo base64_encode("false");
exit;

?>

