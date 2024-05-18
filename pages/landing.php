<div class="flex-1 p-6">
  <?php
  use pages\components\modal;

  require_once ("components/modal.php");

  $alertContent = '<div class="relative z-10 " aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500 bg-opacity-95 transition-opacity"></div>
  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
              <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
              <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Delete this event ?</h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">Are you sure want to delete this event ? This action can not be undo once taken.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
        <a href="index.php?deleteEvent=' . $deleteEvent . '" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</a>
        <a href="index.php?page=home" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</a>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>';
  $popupModal = new modal($alertContent);
  if ($deleteEvent > 0) {
    $popupModal->showModal();
  }
  if (!empty($upcommingEventsData)) { ?>
    <div class="text-sm px-2 py-4 text-gray-500">Upcomming Events</div>
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
                <a target="_blank" href="' . $event["google_calendar_event_id"] . '" class="bg-blue-500 text-white py-1 px-3 rounded">View</a>
                <a href="index.php?page=home&delete=' . $event["id"] . '" class="bg-red-500 text-white py-1 px-3 rounded">Delete</a>
                </div>
            </div>
        </div>';
      }
      ?>
    </div>
  <?php } ?>
  <div class="text-sm px-2 py-4 text-gray-500">Calendar View</div>
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