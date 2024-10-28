<?php
session_start();
require '../database/db.php';

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
    <title>Dashboard</title>
</head>

<body class="bg-gray-100 flex">
    <?php include './partials/sidebar.php'; ?>
    <div class="ml-56 bg-white p-6 rounded-lg shadow-md w-full text-center">
        <h2 class="text-2xl font-bold mb-4">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>You are logged in.</p>

        <div class="flex justify-evenly m-40">
            <div class="dashboard-cards my-10 bg-slate-300 w-52 h-1/3">
                <?php
                $sql = "SELECT * FROM addproducts";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                ?>
                <h2 class="font-bold text-3xl "><?php echo $count; ?></h2>
                <p class="p-2 text-lg">Products</p>
            </div>
            <div class="dashboard-cards my-10 bg-slate-300 w-52 h-1/3">
                <?php
                $sql = "SELECT * FROM addproducts";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                ?>
                <h2 class="font-bold text-3xl "><?php echo $count; ?></h2>
                <p class="p-2 text-lg">Products</p>
            </div>
            <div class="dashboard-cards my-10 bg-slate-300 w-52 h-1/3">
                <?php
                $sql = "SELECT * FROM addproducts";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                ?>
                <h2 class="font-bold text-3xl "><?php echo $count; ?></h2>
                <p class="p-2 text-lg">Products</p>
            </div>
            <div class="dashboard-cards my-10 bg-slate-300 w-52 h-1/3">
                <?php
                $sql = "SELECT * FROM addproducts";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                ?>
                <h2 class="font-bold text-3xl "><?php echo $count; ?></h2>
                <p class="p-2 text-lg">Products</p>
            </div>

        </div>
        <div class="flex-col">
            <div class="bg-slate-300">
                <?php
                $sql = "SELECT * FROM addproducts";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                ?>
                <h2 class="font-bold text-3xl"><?php echo $count; ?></h2>
                <p class="p-2 text-lg">Total Revenue</p>
            </div>

        </div>


    </div>
</body>

</html>