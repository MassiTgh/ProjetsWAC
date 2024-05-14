<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="inscription.css" rel="stylesheet">
    <?php require 'database.php' ?>
    <?php include 'back.php' ?>   
    <title>Inscription</title>
</head>

<body>
    <div class="signup-container">
        <form class="signup-form" action="compte.php" method="POST">
            <h1>Bienvenue</h1>
            <p>Entrez vos coordonnées pour vous inscrire</p>

            <div class="input-group">
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="prenom" placeholder="Prenom" required>
                <input type="text" name="email" placeholder="email" required>
                <input type="password" name="mdp" placeholder="Mot de passe" required>
                <input type="date" name="birthdate" required>
                <input type="text" name="ville" placeholder="Ville" required>
            </div>

            <div class="input-group">
                <select name="genre" required>
                    <option value="">Genre</option>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                    <option value="autre">Autre</option>
                </select>
            </div>

            <div class="input-group">
                <select name="loisir">
                    <option value="">Loisir</option>
                    <option value="sport">Sport</option>
                    <option value="cinema">Cinema</option>
                    <option value="jeuxvideo">Jeux-Video</option>
                    <option value="musique">Musique</option>
                    <option value="lecture">Lecture</option>
                </select>
            </div>

            <button type="submit" name="signup">Inscription</button>
            <div class="bottom-text">
                <p>Vous avez déjà un compte ?<a href="connexion.php">Connectez-vous</a></p>
            </div>
        </form>
    </div>
</body>

</html>