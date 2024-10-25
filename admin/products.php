<?php
session_start();
require '../database/db.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../error/unauthorized.php");
    exit;
}

// Handle product editing
$editProduct = null; // Initialize edit product variable
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $result = $conn->query("SELECT * FROM addproducts WHERE id = $edit_id");
    $editProduct = $result->fetch_assoc();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Initialize variables
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $editId = $_POST['edit_id'] ?? null; // Get edit ID if present
    $oldImagePath = $_POST['old_image'] ?? null; // Save old image path

    // Define target directory
    $targetDir = "uploads/";

    // Initialize target file as old image
    $targetFile = $oldImagePath;

    // Handle new image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = $_FILES['image'];
        $targetFile = $targetDir . uniqid() . '_' . basename($image['name']); // New file path

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Delete old image only if a new image is successfully uploaded
            if ($oldImagePath && file_exists($oldImagePath)) {
                unlink($oldImagePath); // Remove the old image
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
            // Handle error as needed
        }
    }

    // If editing an existing product
    if (!empty($editId)) {
        // Update product details in the database
        $query = "UPDATE addproducts SET 
                    quantity='$quantity', 
                    category='$category', 
                    name='$name', 
                    description='$description', 
                    price='$price', 
                    image='$targetFile' 
                  WHERE id='$editId'";

        if (mysqli_query($conn, $query)) {
            // Redirect to avoid form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            die(mysqli_error($conn)); // Handle error if update fails
        }
    }
    // If adding a new product
    else {
        // Insert the product into the database with the image path
        $query = "INSERT INTO addproducts (quantity, category, name, description, price, image) 
                  VALUES ('$quantity', '$category', '$name', '$description', '$price', '$targetFile')";
        if (mysqli_query($conn, $query)) {
            // Redirect or refresh to avoid form resubmission
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            die(mysqli_error($conn)); // Handle error if insertion fails
        }
    }
}

// Handle product deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $result = $conn->query("SELECT image FROM addproducts WHERE id = $delete_id");
    $row = $result->fetch_assoc();
    $imagePath = $row['image'];

    // Delete the image file from the server
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Delete product from the database
    $conn->query("DELETE FROM addproducts WHERE id = $delete_id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch products for display
$result = mysqli_query($conn, "SELECT * FROM addproducts");
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/05be2a39a6.js" crossorigin="anonymous"></script>
    <title>Products</title>
</head>

<body class="bg-gray-100 flex">
    <?php include './partials/sidebar.php'; ?>
    <div class="ml-56 bg-white p-6 rounded-lg shadow-md w-full">
        <div class="text-center text-2xl mb-4 font-bold">Products</div>

        <div class="my-2">
            <button id="myBtn" class="text-white rounded-lg bg-sky-500 p-2 hover:bg-sky-600 font-semibold"><i class="fa-solid fa-plus mr-2"></i>Add Product</button>
        </div>

        <table class="table-auto border w-full">
            <thead class="border text-left">
                <tr>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr class="border">
                        <td class="px-4 py-2"><?= htmlspecialchars($product['quantity']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($product['category']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($product['name']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($product['description']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($product['price']) ?></td>
                        <td class="px-4 py-2">
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width: 50px; height: 50px;">
                        </td>
                        <td class="hidden"><?= htmlspecialchars($product['id']) ?></td>
                        <td class="px-4 py-2">
                            <button class="bg-sky-500 text-white p-2 rounded edit-button" data-id="<?= $product['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                            <a href="?delete_id=<?= $product['id'] ?>" class="bg-red-500 text-white p-2 rounded" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa-solid fa-trash"></i></a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-lg w-full relative">
            <span class="close absolute top-2 right-2 text-gray-600 hover:text-black cursor-pointer text-2xl">&times;</span>
            <form id="sampleForm" method="POST" action="" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <h2 class="text-lg font-semibold mb-4 col-span-2" id="modalTitle">Add Product</h2>
                <input type="hidden" name="edit_id" id="edit_id">
                <input type="hidden" name="old_image" id="old_image">

                <label class="block mb-2" for="quantity">Quantity</label>
                <input class="border border-gray-300 rounded w-full p-2" type="number" id="pquantity" name="quantity" required>

                <label class="block mb-2" for="category">Category</label>
                <select class="border border-gray-300 rounded w-full p-2" id="category" name="category" required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="Heavy Meal">Heavy Meal</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Add-ons">Add-ons</option>
                    <option value="Rice Meal">Rice Meal</option>
                </select>

                <label class="block mb-2" for="name">Name</label>
                <input class="border border-gray-300 rounded w-full p-2" type="text" id="pname" name="name" required>

                <label class="block mb-2" for="description">Description</label>
                <input class="border border-gray-300 rounded w-full p-2" type="text" id="pdescription" name="description" required>

                <label class="block mb-2" for="price">Price</label>
                <input class="border border-gray-300 rounded w-full p-2" type="number" id="pprice" name="price" required>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2" for="image">Product Image</label>

                    <!-- File input with custom button -->
                    <div class="flex items-center">
                        <label for="image" class="flex items-center justify-center bg-sky-500 text-white rounded-lg cursor-pointer px-4 py-2 hover:bg-sky-600 transition ease-in-out duration-300">
                            <i class="fa-solid fa-upload mr-2"></i>Upload Image
                        </label>
                        <input class="hidden" type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <!-- Image preview -->
                    <div id="imagePreview" class="mt-4 border border-gray-300 rounded-lg h-32 w-full flex items-center justify-center bg-gray-100">
                        <span class="text-gray-400">No image selected</span>
                    </div>
                </div>

                <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white rounded p-2 w-full col-span-1 md:col-span-2">Submit</button>
            </form>
        </div>
    </div>


    <script src="./js/modal.js"></script>
    <script src="./js/imagePreview.js"></script>
</body>

</html>