<?php
$page = isset($_GET["page"]) ? $_GET["page"] : "home";
$deleteEvent = isset($_GET["delete"]) ? $_GET["delete"] : 0;
$performDelete = isset($_GET["deleteEvent"]) ? $_GET["deleteEvent"] : 0;
$successMessage = isset($_GET["success"]) ? $_GET["success"] : "";
$errroMessage = isset($_GET["errorMsg"]) ? $_GET["errorMsg"] : "";
$showModal = isset($_GET["show"]) ? $_GET["show"] : false;
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