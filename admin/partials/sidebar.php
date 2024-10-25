<nav class="p-5 border-r-2 h-full w-56 fixed left-0 top-0 bottom-0 bg-white shadow-lg">
    <div class="h-full flex flex-col">
        <!-- Admin title section -->
        <div class="text-center font-bold text-xl text-sky-600 mb-4">
            Admin Panel
        </div>

        <!-- Main content section with navigation links -->
        <div class="grow py-3 my-3 border-y-2 border-gray-200">
            <ul class="grid gap-y-4">
                <?php
                // Get the current page from the PHP script name
                $currentPage = basename($_SERVER['SCRIPT_NAME'], '.php');
                ?>

                <li class="p-2 rounded-md transition-colors duration-300 <?php echo $currentPage === 'dashboard' ? 'bg-sky-500 text-white' : 'hover:bg-sky-500 hover:text-white'; ?>">
                    <a href="dashboard.php" class="block">Dashboard</a>
                </li>

                <li class="p-2 rounded-md transition-colors duration-300 <?php echo $currentPage === 'products' ? 'bg-sky-500 text-white' : 'hover:bg-sky-500 hover:text-white'; ?>">
                    <a href="products.php" class="block">Products</a>
                </li>

                <li class="p-2 rounded-md transition-colors duration-300 <?php echo $currentPage === 'transactions' ? 'bg-sky-500 text-white' : 'hover:bg-sky-500 hover:text-white'; ?>">
                    <a href="transactions.php" class="block">Transactions</a>
                </li>
            </ul>
        </div>

        <!-- Logout button section -->
        <div class="text-white bg-sky-500 rounded-lg p-2 hover:bg-sky-600 text-center transition-colors duration-300">
            <a href="logout.php" class="block">Log Out</a>
        </div>
    </div>
</nav>
