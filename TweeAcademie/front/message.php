<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style><?php include "./css/normalize.css"?></style>
        <style><?php include "./css/output.css"?></style>
        <style><?php include "./css/style.css"?></style>
        <link rel="stylesheet" href="./css/style_picture.css">
        <link rel="stylesheet" href="./css/style.css">
        <script><?php include "./js/fetchMessages.js"?></script>
<!--        <script>--><?php //include "./js/picture_change.js"?><!--</script>-->
        <script src="https://kit.fontawesome.com/96249701bf.js" crossorigin="anonymous"></script>
        <title>Message</title>
    </head>
    <body class="bg-black h-screen" data-user-id="<?php echo $_GET['userId']; ?>">
        <nav class="main_box ">
            <input type="checkbox" id="check">
            <div class="btn_one">
                <label for="check">
                    <i class="fas fa-bars text-white"></i>
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
                    </ul>
                </div>
            </div>
        </nav>
        <section class="message_page">
            <?php
            require_once "../back/message_instance.php";
            $convoName = urldecode($_GET['convoName']);
//            var_dump($_GET);
            ?>
            <h1 class="message_title"><?php echo $convoName; ?></h1>
            <div class="message_container"></div>
            <section class="send_message_section">
                <form action="../back/handle_messages.php" method="POST">
                    <input type="hidden" name="id_convo" value="<?php echo htmlspecialchars($_GET['convoId']); ?>">
                    <p id="error-message" style="color: red;"></p>
                    <input type="text" name="content" class="message_input" placeholder="Write your message here..." maxlength="400">
                    <button type="submit" class="send_message_button">Envoyer</button>
                </form>
            </section>
        </section>
        <script><?php include "../node_modules/flowbite/dist/flowbite.min.js"?></script>
    </body>
</html>