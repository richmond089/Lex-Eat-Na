<?php
session_start();
require '../database/db.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to unauthorized access page
    header("Location: ../error/unauthorized.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM customers");
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
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

        <table class="table-auto border w-full mt-10">
            <thead class="border text-center">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Full Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Contact</th>
                    <th class="px-4 py-2">Address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr class="border">
                        <td class="px-4 py-2"><?= htmlspecialchars($customer['id']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($customer['fullname']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($customer['email']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($customer['contact']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($customer['address']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>