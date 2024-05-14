<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style><?php include "./css/normalize.css"?></style>
    <style><?php include "./css/output.css"?></style>
    <script><?php include "./js/login.js"?></script>
    <script src="https://kit.fontawesome.com/96249701bf.js" crossorigin="anonymous"></script>
    <title>LOGIN</title>
  </head>
  <body class="bg-black h-screen dark:bg-gray-200">
      <main class="md:flex ">
        <img class="md:h-[calc(100vh-3rem)] md:w-[calc(100%/2)] md:left-0 h-[calc(100vh-75vh)] relative left-[calc(100%/2-14%)]" src="./img/X_logo_2023_(white).png" alt="Logo">
        <div class="md:h-[calc(100vh-3rem)] md:w-[calc(100%/2)] flex flex-col justify-center items-center">
            <h1 class="text-4xl font-bold text-white pb-14 dark:text-black">LOGIN</h1>
            <form action="../back/signin.php" method="post" class="flex flex-col space-y-4 w-full max-w-md">
              <input type="email" name="email" id="username" placeholder="Email" class="p-2 rounded-md bg-gray-800 text-white">
              <p id="error_username" class="text-red-600"></p>
              <input type="password" name="password" id="password" placeholder="Password" class="p-2 rounded-md bg-gray-800 text-white">
              <p id="error_password" class="text-red-600"></p>
              <button type="submit" id="submit" class="p-2 bg-white rounded-md hover:bg-white/80 duration-300">Login</button>
              <a href="#" class="px-2	no-underline text-white text-center	dark:text-black">Forgot password ?</a>
              <p class="text-red-600">Email ou mot de passe incorrecte</p>
              <a href="register.php" class="p-2 no-underline text-white border-t border-solid border-gray-500	text-center	dark:text-black">Not register yet ?</a>
            </form>
        </div>
      </main>
      <footer class="text-white border-t border-solid border-gray-500 text-end pt-2 pr-16 flex justify-between dark:text-black">
        <div class="pl-10">
          <i class="fa-solid fa-moon moon invisible text-white dark:text-black"></i>
          <i class="fa-regular fa-sun sun text-white dark:text-black"></i>
        </div>
        <p>© WAC 2024</p>
      </footer>
      <script><?php include "./js/dark_light.js"?></script>
      <script><?php include "../node_modules/flowbite/dist/flowbite.min.js"?></script>
  </body>
</html>