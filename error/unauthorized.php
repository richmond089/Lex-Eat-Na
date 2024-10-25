<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Unauthorized Access</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96 text-center">
        <h2 class="text-2xl font-bold mb-4">Unauthorized Access</h2>
        <p class="mb-4">You must be logged in to access that page.</p>
        <a href="../admin/login.php" class="bg-blue-500 text-white p-2 rounded">Go to Login</a>
    </div>
</body>
</html>
