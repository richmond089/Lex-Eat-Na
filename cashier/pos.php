<?php
session_start();
require '../database/db.php';

// Fetch products for display
$result = mysqli_query($conn, "SELECT * FROM addproducts");
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Items Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-12 gap-6">
            <!-- Food Items -->
            <div class="col-span-8">
                <h2 class="text-2xl font-bold mb-4">Food Items</h2>
                <div class="grid grid-cols-3 gap-4">

                    <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-lg shadow p-4 cursor-pointer" onclick="addToCart(<?= htmlspecialchars($product['id']) ?>, '<?= htmlspecialchars($product['name']) ?>', <?= htmlspecialchars($product['price']) ?>, '<?= htmlspecialchars($product['image']) ?>')">
                        <img src="../admin/<?= htmlspecialchars($product['image']) ?>" class="w-full h-32 object-cover rounded">
                        <div class="mt-4">
                            <h3 class="font-bold text-lg"><?= htmlspecialchars($product['name'])?></h3>
                            <p class="text-gray-600">₱<?= htmlspecialchars($product['price'])?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Cart -->
            <div class="col-span-4">
                <h2 class="text-2xl font-bold mb-4">Cart</h2>
                <div class="bg-white rounded-lg shadow p-4">
                    <div id="cart-items"></div>

                    <div class="text-right font-bold text-lg mb-4" id="item-total">
                        Item Total: ₱0.00
                    </div>

                    <!-- Checkout Form -->
                    <form id="checkout-form" action="checkout.php" method="POST">
                        <input type="hidden" name="cart_data" id="cart-data">
                        
                        <h3>Select Customer Type:</h3>
                        <select name="customer_type" id="customer-type" onchange="toggleCustomerInfo()">
                            <option value="walk_in">Walk-In</option>
                            <option value="registered">Registered</option>
                        </select>

                        <div id="customer-info" style="display: none;">
                            <label for="customer-id">Registered Customer ID:</label>
                            <input type="number" name="customer_id" id="customer-id" placeholder="Enter customer ID">
                        </div>

                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Checkout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="./js/cart.js"></script>
    <script>
        function toggleCustomerInfo() {
            const customerType = document.getElementById('customer-type').value;
            const customerInfo = document.getElementById('customer-info');
            if (customerType === 'registered') {
                customerInfo.style.display = 'block';
            } else {
                customerInfo.style.display = 'none';
            }
        }

        // Function to add a product to the cart
        function addToCart(id, name, price, image) {
            const existingProduct = cart.find(item => item.id === id);
            
            if (existingProduct) {
                existingProduct.quantity += 1; // Increment the quantity if it exists
            } else {
                // Add a new product to the cart
                cart.push({ id, name, price, quantity: 1, image });
            }

            updateCart(); // Update cart UI
        }

        // Function to update cart UI
        function updateCart() {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = ''; // Clear existing items

            let totalPrice = 0;

            cart.forEach((item) => {
                totalPrice += item.price * item.quantity;

                const cartItem = `
                    <div class="mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="../admin/${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded mr-4">
                                <div>
                                    <h3 class="font-bold">${item.name}</h3>
                                    <p class="text-gray-600">₱${item.price}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <button class="bg-gray-300 p-1 rounded" onclick="changeQuantity(${item.id}, -1)">-</button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="bg-gray-300 p-1 rounded" onclick="changeQuantity(${item.id}, 1)">+</button>
                            </div>
                        </div>
                    </div>
                `;
                cartContainer.innerHTML += cartItem;
            });

            document.getElementById('item-total').textContent = `Item Total: ₱${totalPrice.toFixed(2)}`;
            document.getElementById('cart-data').value = JSON.stringify(cart); // Update hidden input
        }

        // Function to change the quantity of a product in the cart
        function changeQuantity(id, change) {
            const product = cart.find(item => item.id === id);
            if (product) {
                product.quantity += change;

                // Remove product if quantity becomes 0
                if (product.quantity <= 0) {
                    cart = cart.filter(item => item.id !== id);
                }

                updateCart(); // Update cart UI
            }
        }
    </script>
</body>
</html>
