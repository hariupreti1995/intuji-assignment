<!-- <div class="flex-1 p-6">
    <div class="grid grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-lg font-semibold text-start mb-4">Google Calendar</h3>
            <div class="grid grid-flow-col grid-cols-3">
                <div>
                    <img src="https://lh3.googleusercontent.com/PVe1qU58ryjSA4nEllsvJIA1g9qJSu1h8vfHvgOsBhfsNV-gFkCiBl8B6Aqpux9iYoqRdoTLxwvVBVDE1SE=w80-h80" height="80" width="80" />
                </div>
                <div class="col-span-2">
                    <p class="text-gray-600"> Google Calendar API</p>
                    <p class="text-gray-400 text-sm">Manage calendars and events in Google Calendar.</p>
                    <div class="flex justify-end items-center mt-4">
                        <button class="bg-blue-500 text-white py-1 px-3 rounded">Connect</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<?php
session_start();

$client = new Google_Client();
$client->setAuthConfig($_SERVER['DOCUMENT_ROOT'] . '/intuji-assignment/credentials.json');
$client->setRedirectUri('http://localhost/intuji-assignment/index.php');
$client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

if (!isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: http://localhost/intuji-assignment/index.php');
    exit;
}



