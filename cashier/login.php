<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: pos.php");
    exit;
}

// Dummy credentials for demonstration purposes
$valid_username = "user";
$valid_password = "user";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: pos.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Cashier Login</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-3xl font-extrabold text-center text-sky-600 mb-6">Cashier Login</h2>

        <!-- Display error message if login fails -->
        <?php if (isset($error)): ?>
            <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-6">
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                <input type="text" name="username" id="username" required
                    class="border border-gray-300 p-3 w-full rounded focus:outline-none focus:border-sky-500">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="border border-gray-300 p-3 w-full rounded focus:outline-none focus:border-sky-500">
            </div>
            <button type="submit"
                class="bg-sky-500 text-white font-semibold p-3 w-full rounded-lg hover:bg-sky-600 transition duration-300">
                Login
            </button>
        </form>
    </div>
</body>
</html>
