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
    <script src="./js/show_pseudo.js"></script>
    <title>document</title>
</head>
<body class="bg-black dark:bg-gray-200">
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

<main class="pl-80">
    <div class="flex flex-col w-3/5">
        <div id="container" class="flex flex-col ">
            <div class="flex justify-between items-center mx-4" id="img_button">
                <img class= "h-1/3 w-1/3" id="img">
                <?php
                    $pdo = require("../back/database.php");
                    $id_follow = $_GET["pseudo_id"];
                    $id_user = $_SESSION['user_id'];
                    $statement_followings = $pdo->query("SELECT * FROM follow JOIN user ON user.id = follow.id_follow WHERE id_user = $id_user AND id_follow = $id_follow;");
                    $result_check = $statement_followings->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php if ($result_check): ?>
                    <button class='border border-solid border-gray-500 py-2 px-4 rounded-2xl bg-white text-black font-bold h-11 unfollow'>Unfollow</button>
                    <button class='border border-solid border-gray-500 py-2 px-4 rounded-2xl bg-white text-black font-bold h-11 message'>Message</button>
                <?php else: ?>
                    <button class='border border-solid border-gray-500 py-2 px-4 rounded-2xl bg-white text-black font-bold h-11 follow'>Follow</button>
                <?php endif; ?>
            </div>
            <div id="div_info">
                <ul class="text-white dark:text-black mx-4 text-lg">
                    <li class="font-bold text-2xl li1"></li>
                    <li class="text-gray-500 li2"></li>
                    <li class="li3"></li>
                    <li>
                        <ul class="flex text-gray-500">
                            <li class="mr-8 li_city"></li>
                            <li class="li_time"></li>
                        </ul>
                    </li>
                    <li >
                        <ul class="flex">
                            <?php
                                require_once("../back/count_follower_following.php");
                                $id_follow = $_GET["pseudo_id"];
                                $count_followers = count_followers($id_follow);
                                $count_followings = count_followings($id_follow);
                            ?>
                            <li class="mr-10 mt-5">
                                <button data-modal-target="select-modal" data-modal-toggle="select-modal" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                                    <?=$count_followers[0]['Count'] ? $count_followers[0]['Count'] : 0 ?> Followings
                                </button>
                                <div id="select-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Followings List
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="select-modal">
                                                    <svg class="w-3 h-3" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-4 md:p-5">
                                                <?php 
                                                    require_once("../back/get_followings.php");
                                                    $id_user = $_GET["pseudo_id"];
                                                    $followings = get_followings($id_user);
                                                ?>
                                                <ul class="my-4 space-y-3">
                                                <?php foreach($followings as $key => $following):?>
                                                    <li >
                                                        <a href="./profil_search_user.php?pseudo_id=<?=$following["id_follow"]?>" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                                            <img src="./img/<?=$following["profile_picture"]?>" alt="" class="w-11 h-11">
                                                            <span class="flex-1 ms-3 whitespace-nowrap"><?=$following["username"]?></span>
                                                            <span class="flex-1 ms-3 whitespace-nowrap"><?=$following["at_user_name"]?></span>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-5">
                                <button type="button" data-modal-target="crypto-modal" data-modal-toggle="crypto-modal" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                                    <?=$count_followings[0]['Count'] ? $count_followings[0]['Count'] : 0 ?> Followers
                                </button>
                                <div id="crypto-modal" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Followers List
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crypto-modal">
                                                    <svg class="w-3 h-3" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-4 md:p-5">
                                                <?php 
                                                    require_once("../back/get_followers.php");
                                                    $id_user = $_GET["pseudo_id"];
                                                    $followers = get_followers($id_user);
                                                ?>
                                                <ul class="my-4 space-y-3">
                                                <?php foreach($followers as $key => $follower):?>
                                                    <li >
                                                        <a href="./profil_search_user.php?pseudo_id=<?=$follower["id_user"]?>" class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                                            <img src="./img/<?=$follower["profile_picture"]?>" alt="" class="w-11 h-11">
                                                            <span class="flex-1 ms-3 whitespace-nowrap"><?=$follower["username"]?></span>
                                                            <span class="flex-1 ms-3 whitespace-nowrap"><?=$follower["at_user_name"]?></span>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <h3 class="text-white dark:text-black mt-10 text-center mb-2">POST</h3>
        <div id="container_post" class="flex flex-col "></div>
    </div>
    <div class="side-feed"></div>
</main>
<script><?php include "./js/dark_light.js"?></script>
<script><?php include "../node_modules/flowbite/dist/flowbite.min.js"?></script>
</body>
</html>