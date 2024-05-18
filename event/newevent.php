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
require_once __DIR__ . '/../vendor/autoload.php';
require_once '../connection/mysqlconnection.php';

$client = new Google_Client();
$client->setClientId($env['GOOGLE_CLIENT_ID']);
$client->setClientSecret($env['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($env['REDIRECT_URI']);
$client->setScopes([$env['GOOGLE_OAUTH_SCOPE']]);
$client->setIncludeGrantedScopes(true);
$client->setAccessType("offline");
$client->setPrompt("select_account consent");

if (!isset($_GET['code']) && isset($_POST["jsonData"]) && $_POST["jsonData"] != "") {
    $jsonData = json_decode($_POST["jsonData"], true);
    $client->setAuthConfig($jsonData);
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} elseif (isset($_GET['code']) && $_GET["code"] != "") {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token['access_token'];
    $accessToken = $token['access_token'];
    //Record it for future use
    $conn->query("INSERT INTO integrations(data,status,service,token) VALUES('Connection established successfully','connected','google-calendar-api','$accessToken')");
    header("Location: ../index.php?page=integration&success=" . urlencode("Connection successfully established with Google Calender"));
} elseif (isset($_POST["name"]) && !isset($_POST["jsonData"]) && isset($_SESSION['access_token']) && $_SESSION['access_token'] != "") {
    include_once ("validation/event.php");
    if (!empty($errors)) {
        header("Location: ../index.php?page=create&errors=" . urlencode(serialize($errors)) . "&data=" . urlencode(serialize($formData)));
        exit();
    }
    if (empty($errors) && $_SERVER["REQUEST_METHOD"] == "POST" && !empty($formData)) {
        //proceed further
        try {
            $contract = new Event(new EventGateway($formData, "create"));
            $response = $contract->createNewEvent();
            print_r($response);
            header("Location: ../index.php?page=home&success=" . urldecode("New event successfully created"));
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
} else {
    header("Location: ../index.php?page=home&errorMsg=" . urldecode("Please establish connection with the Google Calendar API before continuing."));
    exit();
}