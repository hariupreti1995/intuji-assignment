<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use event\details\Event;
use event\EventGateway;

require_once './contract/EventContract.php';
require_once './details/Event.php';
require_once 'EventGateway.php';

include_once ("validation/event.php");
if (isset($_GET["code"]) && $_GET["code"] != "" ) {

    $contract = new Event(new EventGateway($formData,"create"));
    $data  = $contract->GetAccessToken("100787751218182363929","http://localhost/intuji-assignment/event","453b2611622b94a8ef8d27512a39bbf76d6e0466",$_GET["code"]);
    $access_token = $data['access_token']; 
    $_SESSION['google_access_token'] = $access_token; 
    print_r($access_token);
    die("access token generated");
}

if (!empty($errors)) {
    header("Location: ../index.php?page=create&errors=" . urlencode(serialize($errors)) . "&data=" . urlencode(serialize($formData)));
    exit();
}
if (empty($errors) && $_SERVER["REQUEST_METHOD"] == "POST" && !empty($formData)) {
    //proceed further
    try {
        $contract = new Event(new EventGateway($formData,"create"));
        print_r($contract->createNewEvent());
        die("contract created");
    } catch (\Throwable $th) {
        throw $th;
    }
}