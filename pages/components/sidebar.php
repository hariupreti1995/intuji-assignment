<?php
$activeClass = "block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800 bg-slate-900";
$inactiveClass = "block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-800";
?>
<div class="bg-indigo-900 text-white w-64 space-y-6 py-7 px-2">
    <div class="flex items-center space-x-2 px-4 border-b-2 mb-14 pb-4 border-slate-900">
        <img src="src/images/logo.png" alt="User Avatar" class="h-12 w-12 rounded-full">
        <div>
            <h2
                class="text-lg uppercase font-semibold bg-clip-text text-transparent bg-gradient-to-b from-white to-red-500">
                Eventer</h2>
            <span class="text-[12px] -mt-4 mb-8">Event Management System</span>
        </div>
    </div>
    <nav class="mt-10 ">
        <span class="w-full text-[10px] pl-2">Create</span>
        <a href="?page=create" class="<?php echo strcmp($page, 'create') == 0 ? $activeClass : $inactiveClass ?>">New
            Event</a>
        <span class="w-full text-[10px] pl-2">Management</span>
        <a href="?page=home" class="<?php echo strcmp($page, 'home') == 0 ? $activeClass : $inactiveClass ?>">All Event </a>
        <a href="?page=integration" class="<?php echo strcmp($page, 'integration') == 0 ? $activeClass : $inactiveClass ?>">Integration </a>
    </nav>
</div>