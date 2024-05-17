<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
use event\details\Event;
use event\EventGateway;

require_once './contract/EventContract.php';
require_once './details/Event.php';
require_once 'EventGateway.php';
require_once '../vendor/autoload.php';

$client = new Google\Client();

if (isset($_POST["jsonData"]) && $_POST["jsonData"] != "") {
    //integration connect request
    include ("../connection/mysqlconnection.php");
    $jsonData = json_decode($_POST["jsonData"], true);
    $serializeData = serialize($jsonData);
    $columns = "data,status,service,token";
    $plainData = [$serializeData, "connected", "google-calendar-api", ""];
    $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($plainData));
    $values = implode("', '", $escaped_values);
    $sql = "INSERT INTO `integrations`($columns) VALUES ('$values')";
    if ($conn->query($sql) === TRUE) {
        $lastRecordedId = $conn->insert_id;
        //start google oauth
        $client->setApplicationName("Evento - An Event Managment System");
        $client->addScope(["profile", "email"]);
        $client->setAuthConfig($jsonData);
        $client->setAccessType("offline");
        $client->setPrompt("select_account consent");
        $client->setRedirectUri("http://localhost/intuji-assignment/event/newevent.php");
        $client->setIncludeGrantedScopes(true);
        $auth_url = $client->createAuthUrl();
        header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    }
}

// Handle callback request from google oauth
if (isset($_GET['code']) && $_GET['code'] != "") {
    $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $accessToken;
    $_SESSION['code'] = $_GET['code'];
    header('Location: http://localhost/intuji-assignment/index.php');
    exit;
}

if (isset($_POST["name"]) && !isset($_POST["jsonData"])) {
    include_once ("validation/event.php");

    if (!empty($errors)) {
        header("Location: ../index.php?page=create&errors=" . urlencode(serialize($errors)) . "&data=" . urlencode(serialize($formData)));
        exit();
    }
    if (empty($errors) && $_SERVER["REQUEST_METHOD"] == "POST" && !empty($formData)) {
        //proceed further
        try {
            $contract = new Event(new EventGateway($formData, "create"));
            print_r($contract->createNewEvent());
            die("contract created");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}