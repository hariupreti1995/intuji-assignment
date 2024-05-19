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
        require_once './event/helper.php';
        require_once './pages/components/sidebar.php';
        ?>
        <div class="flex-1 flex flex-col">
            <?php require_once './pages/components/header.php' ?>
            <!-- Dynamic Main Content -->
            <?php echo $successMessage != "" ? '<span class=" p-4 mx-4 my-2 bg-green-400">' . $successMessage . '</span>' : "" ?>
            <?php echo $errroMessage != "" ? '<span class=" p-4 mx-4 my-2 bg-red-400">' . $errroMessage . '</span>' : "" ?>
            <?php require_once './router.php' ?>
        </div>
    </div>
</body>

</html>