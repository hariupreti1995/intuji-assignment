<?php
$title = "All Events";
switch ($page) {
    case 'create':
        $title = "Create Event";
        break;
    case 'home':
        $title = "All Events";
        break;
    default:
        $title = "All Events";
        break;
}
?>
<header class="bg-gradient-to-r from-pink-500 to-red-500 text-white py-4 px-6 flex justify-between items-center">
    <div class="text-xl"><?php echo $title; ?></div>
    <div>
        <input type="text" placeholder="Search events"
            class="rounded-full py-2 px-4 bg-gray-200 text-gray-700 placeholder-gray-400">
    </div>
</header>