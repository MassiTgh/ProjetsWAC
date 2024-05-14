<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/output.css">
    <script src="https://kit.fontawesome.com/96249701bf.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,100,1,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="./js/search_member.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Pseudo @ <?=$_GET["user"]?> </title>
</head>
<body class="bg-black  dark:bg-gray-200">
    <?php 
        require_once("../back/is_login.php");
        $user = is_login();
    ?>
    <header class="flex flex-col justify-between w-1/4 h-full fixed border-r border-solid border-gray-500">
        <div class="flex flex-col w-full h-3/4 justify-between">
            <a href="./homepage.php" class="text-white dark:text-black flex items-center text-2xl p-2 pr-6 pl-2 w-fit hover:bg-gray-800 hover:rounded-full ">
                <i class="fa-solid fa-house"></i>
               <span class="ml-4">Accueil</span>
            </a>
            <a href="./profil.php" class="text-white dark:text-black flex items-center text-2xl p-2 pr-6 pl-2 w-fit hover:bg-gray-800 hover:rounded-full ">
                <i class="fa-solid fa-user"></i>
                <span class="ml-4">Profil</span>
            </a>
            <a href="./notification.php" class="text-white dark:text-black flex items-center text-2xl p-2 pr-6 pl-2 w-fit hover:bg-gray-800 hover:rounded-full ">
                <i class="fa-solid fa-bell"></i>
                <span class="ml-4">Notification</span>
            </a>
            <a href="./message_selection.php" class="text-white dark:text-black flex items-center text-2xl p-2 pr-6 pl-2 w-fit hover:bg-gray-800 hover:rounded-full ">
                <i class="fa-solid fa-envelope"></i>
                <span class="ml-4">Message</span>
            </a>
            <form method="GET" id="submit_search" class="flex items-center text-2xl p-2 pr-6 pl-2 w-fit hover:bg-gray-800 hover:rounded-full ">
                <i class="fa-solid fa-magnifying-glass text-white dark:text-black"></i>
                <input type="search" name="" id="search_hashtag" class="ml-4 rounded-full bg-gray-800 text-white mr-5" placeholder="Rechercher par #" />
            </form>
            <p id="error_hashtag" class="text-red-600 ml-5"></p>
        </div>
        <div class="flex">
            <div>
                <i class="fa-solid fa-moon moon invisible text-white dark:text-black"></i>
                <i class="fa-regular fa-sun sun text-white dark:text-black"></i>
            </div>
            <p class="ml-5 text-white dark:text-black">Theme</p>
        </div>
        <a href="./profil.php" class="text-white dark:text-black hover:bg-gray-800 hover:rounded-full text-base flex justify-between items-center py-2 pr-2.5 pl-3.5 mr-2.5">
            <img class="w-11 h-11 rounded-full bg-white" src="./img/<?=$user[0]["profile_picture"]?>" alt="">
            <div class="flex flex-col basis-3/4	ml-2.5 text-base">
                <span class="font-medium"><?=$user[0]["username"]?></span>
                <span class="text-gray-500"><?=$user[0]["at_user_name"]?></span>
            </div>
            <i class="material-icons outlined">
                More_horiz
            </i>
        </a>
    </header>
    
    <main class="ml-80">
        <div class="flex flex-col w-3/5">
            <form method="GET" class="flex justify-between items-center text-white text-2xl py-4" id="submit_search_user">
                <input type="search" name="" id="search_user" class="w-full rounded-full bg-gray-800 text-white mr-5" value="<?=$_GET["user"]?>" autocomplete="off" onKeyUp="keyUp()">
                <i class="fa-solid fa-magnifying-glass text-sm"></i>
            </form>
            <p id="error_pseudo" class="text-red-600 ml-5"></p>
            <div class="result_box_search text-white"></div>
            <div id="container" class="text-white dark:text-black flex flex-col	ml-4 p-2">
            </div>
        </div>
        <div class="side-feed"></div>
    </main>
    <script src="./js/autocomplete_all_user.js"></script>
    <script><?php include "./js/dark_light.js"?></script>
    <script><?php include "../node_modules/flowbite/dist/flowbite.min.js"?></script>
</body>
</html>