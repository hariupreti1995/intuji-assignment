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
        <?php include './connection/mysqlconnection.php' ?>
        <?php include './pages/components/sidebar.php' ?>
        <div class="flex-1 flex flex-col">
            <?php include './pages/components/header.php' ?>
            <!-- Main Content -->
            <?php include './pages/landing.php' ?>
        </div>
    </div>
</body>
</html>