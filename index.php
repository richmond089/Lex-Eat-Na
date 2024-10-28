<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="./output.css" rel="stylesheet"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/05be2a39a6.js" crossorigin="anonymous"></script>
    <title>Lex Eat Na</title>
</head>

<body>
    <!-- NavBar -->
    <?php include "./partials/navbar.php"; ?>

    <!-- Search For Food -->
    <div class="bg-cover flex justify-center bg-no-repeat h-64 bg-center" style="background-image: url(./images/bg.jpg)">
        <div class="content-center">
            <input type="search" name="" id="" class="p-2 rounded w-[607px]" placeholder="Search for Food..">
            <input type="button" value="Search" class="bg-slate-600 text-white text p-2 rounded">
        </div>
    </div>

    <!-- Category -->
    <div class="my-10">
        <div class="text-center font-semibold text-3xl mb-4">
            Food Category
        </div>
        <div class="card m-4 border rounded-lg w-72 overflow-hidden">
            <img src="./images/sisig.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text m-2">Sisig</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include './partials/footer.php'; ?>

</body>

</html>