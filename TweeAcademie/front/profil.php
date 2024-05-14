<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/output.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://kit.fontawesome.com/96249701bf.js" crossorigin="anonymous"></script>
    <title>My Account</title>
</head>
<body class="bg-black h-screen dark:bg-gray-200">
    <nav class="main_box">
        <input type="checkbox" id="check">
        <div class="btn_one ">
            <label for="check">
                <i class="fas fa-bars text-white dark:text-black"></i>
            </label>
        </div>
        <div class="sidebar_menu">
            <div class="logo">
                <a href="./homepage.php">Twitter</a>
            </div>
            <div class="btn_two">
                <label for="check">
                    <i class="fas fa-times"></i>
                </label>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <i class="fas fa-qrcode"></i>
                        <a href="./profil.php">Profil</a>
                    </li>
                    <li>
                        <i class="fas fa-link"></i>
                        <a href="./message_selection.php">Message</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-bell"></i>
                        <a href="./notification.php">Notification</a>
                    </li>
                    <li>
                        <i class="fa-regular fa-pen-to-square"></i>
                        <a href="./edit_profil.php">Editer</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-right-from-bracket"></i>                        
                        <a href="../back/logout.php">Déconnexion</a>
                    </li>  
                    <li class="flex">
                        <div>
                            <i class="fa-solid fa-moon moon invisible text-black"></i>
                            <i class="fa-regular fa-sun sun text-black"></i>
                        </div>
                        <p class="ml-5">Theme</p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="md:flex">
        <?php 
            require_once("../back/is_login.php");
            $user = is_login();
            require_once("../back/count_follower_following.php");
            $id = $user[0]["id"];
            $count_followers = count_followers($id);
            $count_followings = count_followings($id);
                        
        ?>
        <header class="md:h-[calc(100vh-13vh)] md:w-[calc(100%/2-10%)] pl-10">
            <div class="h-[calc(100vh-50vh] w-[calc(100%-40%)]">
                <img class="rounded-full" src="<?=$user[0]["profile_picture"]?"./img/".$user[0]["profile_picture"]:"./img/X_logo_2023_(white).png"?>" alt="photo de profil">
            </div>
            <button data-modal-target="select-modal" data-modal-toggle="select-modal" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                <?=$count_followers[0]['Count']?> Followings
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
                                $id_user = $_SESSION['user_id'];
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
            <button type="button" data-modal-target="crypto-modal" data-modal-toggle="crypto-modal" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                <?=$count_followings[0]['Count']?> Followers
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
                                $id_user = $_SESSION['user_id'];
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
        </header>

        <main class="md:h-[calc(100vh-13vh)] md:w-[calc(100%/2+15%)] flex mr-10">
            <section class="mr-10 basis-6/12">
                <ul class="p-3 rounded-lg border border-solid border-gray-300 text-white text-md dark:border-black dark:text-black dark:border-2">Public  
                    <li>User Name :</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white  text-sm"><?=$user[0]["username"]?></li>
                    <li>@ : </li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm"><?=$user[0]["at_user_name"]?></li>
                    <li>Birthday :</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm"><?=$user[0]["birthdate"]?></li>
                    <li>Creation Time :</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm"><?=$user[0]["creation_time"]?></li>
                    <li>City :</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm"><?=$user[0]["city"]?></li>
                    <li>Campus :</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm"><?=$user[0]["campus"]?$user[0]["campus"]:"Non renseigner"?></li>
                    <li>Bio :</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm"><?=$user[0]["bio"]?$user[0]["bio"]:"Non renseigner"?></li>
                </ul>
            </section>
            <section class="privateinfos basis-6/12 flex flex-col">
                <ul class="p-3 rounded-lg border border-solid border-gray-300 text-white text-md dark:border-black dark:text-black dark:border-2">Private<br>
                    <li>Email :</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm"><?=$user[0]["mail"]?></li>
                    <li>Mot de passe</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm">**********</li>
                    <li>City :</li>
                    <li class="p-2 rounded-md bg-gray-800 text-white text-sm"><?=$user[0]["city"]?></li>
                </ul>
                <a href="./edit_profil.php" class="mt-10 p-2 px-4 bg-white opacity-50 rounded-xl hover:bg-white/80 duration-300 dark:bg-black dark:text-white dark:border-2">Editer son compte</a>
            </section>
        </main>
    </div>
    <script><?php include "./js/dark_light.js"?></script>
    <script><?php include "../node_modules/flowbite/dist/flowbite.min.js"?></script>
</body>
</html>