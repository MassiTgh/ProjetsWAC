<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="connexion.css" rel="stylesheet">
    <?php require 'database.php' ?>
    <?php include 'back.php' ?>
    <title>Connexion</title>
</head>

<body>
    <div class="login-container">
        <form class="login-form" action="compte.php" method="POST">
            <h1>Heureux de vous revoir</h1>
            <p>Entrez vos identifiants pour vous connecter</p>

            <div class="input-group">
                <input type="text" id="username" name="email" placeholder="email" required>
            </div>

            <div class="input-group">
                <input type="password" id="password" name="mdp" placeholder="Mot de passe" required>
            </div>

            <button type="submit" name="login">Connexion</button>

            <div class="bottom-text">
                <p>Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
                <p><a href="#">Mot de passe oublié ?</a></p>
            </div>
        </form>
    </div>
</body>

</html>