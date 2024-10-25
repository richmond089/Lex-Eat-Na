let cart = [];

// Function to add a product to the cart
function addToCart(id, name, price, image) {
    const existingProduct = cart.find(item => item.id === id);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ id, name, price, quantity: 1, image });
    }
    updateCart();
}

// Function to update cart UI
function updateCart() {
    const cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = '';
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
}

// Function to change the quantity of a product in the cart
function changeQuantity(id, change) {
    const product = cart.find(item => item.id === id);
    if (product) {
        product.quantity += change;
        if (product.quantity <= 0) {
            cart = cart.filter(item => item.id !== id);
        }
        updateCart();
    }
}

// Prepare checkout by populating the hidden form and submitting
function prepareCheckout() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    document.getElementById('cart-data').value = JSON.stringify(cart);
    document.getElementById('checkout-form').submit();
}