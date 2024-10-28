<?php
require './database/db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    $address = htmlspecialchars($_POST['address']);
    $created_at = date('Y-m-d H:i:s'); // Get current timestamp

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "INSERT INTO customers (username, password, fullname, email, contact, address, created_at) VALUES ('$username', '$hashed_password', '$fullname', '$email', '$contact', '$address', '$created_at')";

    // Execute the query and check if successful
    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    <title>Register</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <form action="" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your username">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your password">
            </div>
            <div class="mb-4">
                <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="fullname" id="fullname" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your full name">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your email">
            </div>
            <div class="mb-4">
                <label for="contact" class="block text-sm font-medium text-gray-700">Contact Number</label>
                <input type="text" name="contact" id="contact" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your contact number">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" id="address" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" placeholder="Enter your address" rows="3"></textarea>
            </div>
            <input type="hidden" name="created_at" value="<?php echo $created_at; ?>">
            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600">Register</button>
        </form>
    </div>
</body>
</html>
