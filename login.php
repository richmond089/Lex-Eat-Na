<?php
session_start(); // Start the session
require './database/db.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: welcome.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Prepare the SQL statement
    $sql = "SELECT * FROM customers WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['loggedin'] = true;
            header("Location: welcome.php"); // Redirect to welcome page
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User does not exist.";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <?php if (isset($error)): ?>
            <div class="text-red-500 mb-4"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your username">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your password">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600">Login</button>
        </form>
        <div class="mt-4 text-center">
            <a href="register.php" class="text-blue-500">Don't have an account? Sign up</a>
        </div>
    </div>
</body>
</html>
