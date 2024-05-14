<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style><?php include "./front/css/normalize.css"?></style>
    <style><?php include "./front/css/output.css"?></style>
    <script src="https://kit.fontawesome.com/96249701bf.js" crossorigin="anonymous"></script>
    <title>Tweet Academy</title>
</head>
<body class="bg-black h-screen dark:bg-gray-200">
    <main class="md:flex ">
        <img class="md:h-[calc(100vh-3rem)] md:w-[calc(100%/2)] md:left-0 h-[calc(100vh-75vh)] relative left-[calc(100%/2-14%)]" src="./front/img/X_logo_2023_(white).png" alt="Logo">
        <div class="md:h-[calc(100vh-3rem)] md:w-[calc(100%/2)] flex flex-col justify-center items-center">
            <button class="p-2 bg-white text-black rounded-md hover:bg-white/80 duration-300 w-96 mb-10 dark:bg-gray-500 dark:text-white"><a href="./front/login.php">Login</a></button>
            <button class="p-2 bg-white text-black rounded-md hover:bg-white/80 duration-300 w-96 dark:bg-gray-500 dark:text-white"><a href="./front/register.php">Register</a></button>
        </div>
    </main>
    <footer class="text-white border-t border-solid border-gray-500 text-end pt-2 pr-16 flex justify-between dark:text-black">
    <div class="pl-10">
        <i class="fa-solid fa-moon moon invisible text-white dark:text-black"></i>
        <i class="fa-regular fa-sun sun text-white dark:text-black"></i>
    </div>
    <p>© WAC 2024</p>
    </footer>
    <script><?php include "./front/js/dark_light.js"?></script>
    <script><?php include "./node_modules/flowbite/dist/flowbite.min.js"?></script>
</body>
</html>