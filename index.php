<?php
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="refresh" content="<?php echo $sec ?>;URL='<?php echo $page ?>'">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="bg-indigo-900 text-white w-64 space-y-6 py-7 px-2">
            <div class="flex items-center space-x-2 px-4 border-b-2 mb-14 pb-4 border-slate-900">
                <img src="src/images/logo.png" alt="User Avatar" class="h-12 w-12 rounded-full">
                <div class="">
                    <h2 class="text-lg font-semibold">Evento</h2>
                    <span class="text-[12px] text-slate-50 pb-6">Event Management System</span>
                </div>
            </div>
            <nav class="mt-10 ">
                <span class="w-full text-[10px] pl-2">Create</span>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800">New Event</a>
                <span class="w-full text-[10px] pl-2">Management</span>
                <a href="#"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800 bg-slate-800">All
                    Event</a>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header
                class="bg-gradient-to-r from-pink-500 to-red-500 text-white py-4 px-6 flex justify-between items-center">
                <div class="text-xl">All Events</div>
                <div>
                    <input type="text" placeholder="Search"
                        class="rounded-full py-2 px-4 bg-gray-200 text-gray-700 placeholder-gray-400">
                </div>
            </header>
            <!-- Content -->
            <div class="flex-1 p-6">
                <div class="text-sm px-2 py-6">Upcomming Events</div>
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Card -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="text-lg font-semibold">Name of events</h3>
                        <p class="text-gray-600">Events Location</p>
                        <p class="text-gray-400 text-sm">Description of events</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-gray-400 text-sm">25 March 2024</span>
                            <button class="bg-red-500 text-white py-1 px-3 rounded">View</button>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="text-lg font-semibold">Name of events</h3>
                        <p class="text-gray-600">Events Location</p>
                        <p class="text-gray-400 text-sm">Description of events</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-gray-400 text-sm">25 March 2024</span>
                            <button class="bg-red-500 text-white py-1 px-3 rounded">View</button>
                        </div>
                    </div>
                </div>
                <div class="text-sm px-2 py-6">Calendar View</div>
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
        </div>
    </div>
</body>

</html>