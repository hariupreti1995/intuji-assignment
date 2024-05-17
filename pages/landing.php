<div class="flex-1 p-6">
    <?php
    use pages\components\modal;
    require_once ("components/modal.php");

    $alertContent = '<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
          <a href="?page=integration" class="inline-flex w-full justify-center rounded-md bg-slate-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-600 sm:ml-3 sm:w-auto">Close</a>
          <button type="submit" class="inline-flex w-full justify-center rounded-md bg-green-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Connect Now</button>
        </div>
      </div>
        </form>
      </div>
    </div>
    </div>';
    $popupModal = new modal($alertContent);
    // $popupModal->showModal();
    if (!empty($upcommingEventsData)) { ?>
        <div class="text-sm px-2 py-6 text-gray-500">Upcomming Events</div>
        <div class="grid grid-cols-2 gap-6 mb-6">
            <?php
            foreach ($upcommingEventsData as $key => $event) {
                echo '<div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-lg font-semibold">' . $event['name'] . '</h3>
            <p class="text-gray-600">' . $event['location'] . '</p>
            <p class="text-gray-400 text-sm">' . $event['description'] . '</p>
            <div class="flex flex-row justify-between  mt-4">
                <span class="text-gray-400 text-sm">' . $event['date'] . '</span>
                <div>
                <button class="bg-blue-500 text-white py-1 px-3 rounded">View</button>
                <button class="bg-red-500 text-white py-1 px-3 rounded">Delete</button>
                </div>
            </div>
        </div>';
            }
            ?>
        </div>
    <?php } ?>
    <div class="text-sm px-2 py-6 text-gray-500">Calendar View</div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-2">
            <div>
                <h3 class="text-lg font-semibold mb-4">Monthly</h3>
            </div>
            <div class="grid place-content-end -mt-4 p-4">
                <select class="bg-slate-50 p-2">
                    <option>All Events</option>
                    <option>Upcomming Events</option>
                    <option>Past Events</option>
                </select>
            </div>
        </div>
        <div class="h-64 bg-gray-100 rounded"></div>
    </div>
</div>