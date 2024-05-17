<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="icon" type="image/x-icon" href="src/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <?php
        require_once 'vendor/autoload.php';
        require_once './connection/mysqlconnection.php';
        $page = isset($_GET["page"]) ? $_GET["page"] : "home";
        $showModal = isset($_GET["show"]) ? $_GET["show"] : false;
        $pagesPath = __DIR__ . "/pages/";
        print_r($_SESSION);
        // Handle callback request from google oauth
        if (isset($_GET['code']) && $_GET['code'] != "") {
            $client = new Google_Client();
            $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access_token'] = $accessToken;
            header('Location: http://localhost/intuji-assignment/index.php');
            exit;
        }

        include_once './pages/components/sidebar.php';
        ?>
        <div class="flex-1 flex flex-col">
            <?php include_once './pages/components/header.php' ?>
            <!-- Dynamic Main Content -->
            <?php require_once './router.php' ?>
        </div>
    </div>
</body>

</html>