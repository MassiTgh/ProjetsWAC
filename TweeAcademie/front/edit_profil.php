<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/output.css">
    <link rel="stylesheet" href="./css/style_picture.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./js/picture_change.js"></script>
    <script src="https://kit.fontawesome.com/96249701bf.js" crossorigin="anonymous"></script>
    <title>Editer donnees personnel</title>
  </head>
  <body class="bg-black h-screen dark:bg-gray-200">
  <nav class="main_box ">
        <input type="checkbox" id="check">
        <div class="btn_one">
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
                        <i class="fa-solid fa-house"></i>
                        <a href="./homepage.php">Homepage</a>
                    </li>
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
    <?php 
        require_once("../back/is_login.php");
        $user = is_login();
    ?>
    <form action="../back/edit_account.php" method="post" class="md:flex">
        
        <header class="md:h-[100vh-5rem] md:w-[calc(100%/2)] pl-10">
            <h1 class="text-2xl font-bold text-white pb-7 dark:text-black">Éditer son profil</h1>
            <div class="profile-pic" id="div_profil">
                <img src="./img/default_avatar.png" alt="avatar" id="avatar" class="bg-white w-full">
                <input type="file" name="file" id="file">
                <label for="file" id="label_file"><i class="fa-solid fa-camera"></i></label>
            </div>
        </header>
        <div class="lg:h-[calc(100vh-5rem)] lg:w-[calc(100%/2)] flex flex-col space-y-2 w-full max-w-md">
            <input type="text" name="name" id="name" placeholder="Prenom" class="p-2 rounded-md bg-gray-800 text-white">
            <p id="error_name" class="text-red-600"></p>
            <input type="text" name="username" id="username" placeholder="Username" class="p-2 rounded-md bg-gray-800 text-white">
            <p id="error_username" class="text-red-600"></p>
            <input type="password" name="password" id="password" placeholder="Password" class="p-2 rounded-md bg-gray-800 text-white">
            <p id="error_password" class="text-red-600"></p>
            <input type="text" name="city" id="city" placeholder="City" class="p-2 rounded-md bg-gray-800 text-white">
            <p id="error_city" class="text-red-600"></p>
            <input type="text" name="bio" id="bio" placeholder="Bio" class="p-2 rounded-md bg-gray-800 text-white">
            <p id="error_bio" class="text-red-600"></p>
            <input type="text" name="campus" id="campus" placeholder="Campus" class="p-2 rounded-md bg-gray-800 text-white">
            <p id="error_campus" class="text-red-600"></p>
            
            <div class="flex  items-center">
                <label for="private" class="text-white mr-10 dark:text-black">Privé</label>
                <?= $user[0]["private"] && $user[0]["private"]!= "NULL" ? "<input type='checkbox' name='private' value='oui' checked>": "<input type='checkbox' class='dark:bg-black' name='private' value='oui'>"?>
            </div>
            
            <button type="submit" id="submit" class="p-2 bg-white rounded-md hover:bg-white/80 duration-300 dark:text-white dark:bg-black">Modifier</button>
        </div>
    </form>
    <script><?php include "./js/dark_light.js"?></script>
    <script><?php include "../node_modules/flowbite/dist/flowbite.min.js"?></script>
  </body>
</html>