<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="./output.css" rel="stylesheet"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/05be2a39a6.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Lex Eat Na</title>
</head>

<body>
    <!-- NavBar -->
    <div class="flex justify-between px-12 py-2 bg-slate-200">
        <img src="./images/logo_lex.png" alt="" class="h-28">

        <div class="content-center font-semibold grid gap-x-8 grid-cols-5 text-center">
            <a href="#">Home</a>
            <a href="#">Categories</a>
            <a href="#">Foods</a>
            <a href="about.php">About Us</a>
            <a href="#">Login</a>
        </div>
    </div>

    <!-- Search For Food -->
    <div class="bg-cover flex justify-center bg-no-repeat h-64 bg-center" style="background-image: url(./images/bg.jpg)">
        <div class="content-center">
            <input type="search" name="" id="" class="p-2 rounded w-[607px]" placeholder="Search for Food..">
            <input type="button" value="Search" class="bg-slate-600 text-white text p-2 rounded">
        </div>
    </div>

    <!-- Category -->
    <div>
        <div class="text-center mt-10 font-semibold text-3xl mb-4">
            Food Category
        </div>
        <div class="card m-4" style="width: 18rem;">
            <img src="./images/sisig.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="flex flex-col items-center bg-slate-200 text-sm">
        <a href="https://www.facebook.com/p/LEX-eat-naaa-100063889632228/?_rdr" class="hover:text-blue-800 text-2xl my-3">
            <i class="fa-brands fa-facebook-f"></i>
        </a>

        <div class="flex justify-between w-80">

            <a href="">Contact Us</a>
            <a href="">Our Services</a>
            <a href="">Address</a>
        </div>
        <div class="text-center my-3">
            <p>LEX EAT NAAA Copyright © 2024 | Designed by iTech </p>
        </div>
    </div>

</body>

</html>