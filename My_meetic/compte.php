<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="compte.css" rel="stylesheet">
    <?php require 'database.php' ?>
    <?php include 'back.php' ?>
    <title>Mon Compte</title>
</head>

<body>
    <?php foreach($liste as $i) : ?>
        <div>
            <h1>Mon compte</h1>
            <p>Nom: <?= $i["nom"];?></p> 
            <p>Prénom: <?= $i["prenom"];?></p> 
            <p>Date de naissance: <?= $i["birthdate"];?></p> 
            <p>Genre: <?= $i["genre"];?></p> 
            <p>Ville: <?= $i["ville"];?></p> 
            <p>Email: <?= $i["email"];?></p> 
            <p>Mot de passe: <?= $i["mdp"];?></p> 
            <p>Loisir: <?= $i["loisir"];?></p>
        </div>
    <?php endforeach; ?>
</body>

</html>