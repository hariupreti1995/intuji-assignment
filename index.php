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
        $deleteEvent = isset($_GET["delete"]) ? $_GET["delete"] : 0;
        $performDelete = isset($_GET["deleteEvent"]) ? $_GET["deleteEvent"] : 0;
        $successMessage = isset($_GET["success"]) ? $_GET["success"] : "";
        $errroMessage = isset($_GET["errorMsg"]) ? $_GET["errorMsg"] : "";
        $showModal = isset($_GET["show"]) ? $_GET["show"] : false;
        $pagesPath = __DIR__ . "/pages/";
        include_once './pages/components/sidebar.php';
        //Delete event
        if ($performDelete > 0) {
            //Remove event from calendar
            $eventSql = "SELECT * FROM events WHERE id = $performDelete";
            $details = $conn->query($eventSql)->fetch_assoc();
            $gcEventId = $details["google_calendar_event_id"];
            $accessToken = $_SESSION['access_token'];
            if (!empty($gcEventId)) {
                $client = new \Google_Client();
                $client->setAccessToken($accessToken);
                $service = new \Google\Service\Calendar($client);
                $service->events->delete('primary', $gcEventId);
            }
            $deleteEventQuery = "DELETE FROM events WHERE id = $performDelete";
            $response = $conn->query($deleteEventQuery);
            header("Location: index.php?page=home&success=" . urlencode("Event successfully deleted"));
            exit();
        }

        //Fetch recorded information
        $today = date('Y-m-d');
        $upcommingEventsQuery = "SELECT * FROM events WHERE date >= $today ORDER BY id DESC LIMIT 4";
        $upcommingEvents = $conn->query($upcommingEventsQuery);
        $upcommingEventsData = [];
        while ($row = $upcommingEvents->fetch_assoc()) {
            $upcommingEventsData[] = $row;
        }
        ?>
        <div class="flex-1 flex flex-col">
            <?php include_once './pages/components/header.php' ?>
            <!-- Dynamic Main Content -->
            <?php echo $successMessage != "" ? '<span class=" p-4 mx-4 my-2 bg-green-400">' . $successMessage . '</span>' : "" ?>
            <?php echo $errroMessage != "" ? '<span class=" p-4 mx-4 my-2 bg-red-400">' . $errroMessage . '</span>' : "" ?>
            <?php require_once './router.php' ?>
        </div>
    </div>
</body>

</html>