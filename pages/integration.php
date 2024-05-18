<?php
use pages\components\modal;

require_once ("components/modal.php");

$modalContent = '<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
<div class="fixed inset-0 z-10 w-screen overflow-y-auto">
  <div class="flex min-h-full items-end justify-center text-center sm:items-center sm:p-0">
    <form method="post" action="event/newevent.php">
    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
    <div class="bg-white sm:p-2 mt-4 sm:pb-4">
      <div class="sm:flex sm:items-start">
        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
          <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Connect with Google Calendar API</h3>
          <div class="mt-2">
            <p class="text-sm text-gray-500">Paste valid json data and click on connect now button to proceed further</p>
          </div>
          <div class="my-2">
          <textarea rows="8" name="jsonData" class="bg-slate-200 p-2 focus:border-none outline-none rounded-md w-full mt-1.5"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:flex justify-between sm:px-6">
      <a href="index.php?page=integration" class="inline-flex w-full justify-center rounded-md bg-slate-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-600 sm:ml-3 sm:w-auto">Close</a>
      <button type="submit" class="inline-flex w-full justify-center rounded-md bg-green-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Connect Now</button>
    </div>
  </div>
    </form>
  </div>
</div>
</div>';

if (isset($_GET["disconnect"]) && $_GET["disconnect"] == true) {
  $delQuery = "DELETE FROM integrations WHERE id > 0";
  $conn->query($delQuery);
}
$data = [];
$getIntegrationStatus = "SELECT * FROM integrations WHERE status = 'connected' AND service = 'google-calendar-api' and token != '' ORDER BY id DESC LIMIT 1";
if ($result = $conn->query($getIntegrationStatus)) {
  $data = $result->fetch_assoc();
}
if ($showModal) {
  $modal = new modal($modalContent);
  $modal->showModal();
}
?>
<div class="flex-1 p-6">
  <div class="grid grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-4">
      <h3 class="text-lg font-semibold text-start mb-4">Google Calendar</h3>
      <div class="grid grid-flow-col grid-cols-3">
        <div>
          <img
            src="https://lh3.googleusercontent.com/PVe1qU58ryjSA4nEllsvJIA1g9qJSu1h8vfHvgOsBhfsNV-gFkCiBl8B6Aqpux9iYoqRdoTLxwvVBVDE1SE=w80-h80"
            height="80" width="80" />
        </div>
        <div class="col-span-2">
          <p class="text-gray-600"> Google Calendar API</p>
          <p class="text-gray-400 text-sm">Manage calendars and events in Google Calendar.</p>
          <?php
          if (!empty($data)) {
            echo '<div class="flex justify-between items-center mt-4">
                        <span class="text-[12px] text-green-600">connected</span>
                        <a href="?page=integration&disconnect=true" class="bg-red-500 text-white py-1 px-3 rounded">Disconnect
                        </a>
                    </div>';
          } else {
            echo '<div class="flex justify-end items-center mt-4">
                            <a href="?page=integration&show=true" class="bg-blue-500 text-white py-1 px-3 rounded">Connect
                            </a>
                        </div>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>