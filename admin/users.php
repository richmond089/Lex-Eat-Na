<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to unauthorized access page
    header("Location: ../error/unauthorized.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Users</title>
</head>

<body class="bg-gray-100 flex">
    <?php include './partials/sidebar.php'; ?>
    <div class="ml-56 bg-white p-6 rounded-lg shadow-md w-full text-center">
        <div class="text-2xl font-bold">Manage Users</div>
    </div>
</body>

</html>