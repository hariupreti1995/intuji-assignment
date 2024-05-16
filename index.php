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
        $page = isset($_GET["page"]) ? $_GET["page"] : "home";
        $pagesPath = __DIR__ . '/pages/';
        include './connection/mysqlconnection.php';
        include './pages/components/sidebar.php';
        ?>
        <div class="flex-1 flex flex-col">
            <?php include './pages/components/header.php' ?>
            <!-- Dynamic Main Content -->
            <?php require_once './router.php' ?>
        </div>
    </div>
</body>

</html>