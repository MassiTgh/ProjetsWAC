<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cinema.css">
    <script defer href="cinema.js"></script>
    <title>Cinema</title>
</head>
<body>
    <!-- INPUT RECHERCHE -->
    <form action="" method="GET">
        Titre <input type="text" name="titre" placeholder="spider-man"/>
        Distributeur <input type="text" name="distributeur" placeholder="marvel"/>
        <select action="" name="genre">
            <option value="">Selectionner un genre</option>
            <option value = "1">Action</option>
            <option value = "2">Animation</option>
            <option value = "3">Adventure</option>
            <option value = "4">Drama</option>
            <option value = "5">Comedie</option>
            <option value = "6">Mystery</option>
            <option value = "7">Biography</option>
            <option value = "8">Crime</option>
            <option value = "9">Fantasy</option>
            <option value = "10">Horror</option>
            <option value = "11">Sci-Fi</option>
            <option value = "12">Romance</option>
            <option value = "13">Family</option>
            <option value = "14">Thriller</option>
            <input type="submit" value="submit"/>
        </select>
        <p></p>
        Nom d'utilisateur <input type="text" name="nom" placeholder="Rodgers"/>
        Prenom d'utilisateur <input type="text" name="prenom" placeholder="Ellen"/>
            <input type="submit" value="Recherche"/>

        <p></p>

        Historique de membre <input type="number" name="idmember" placeholder="Numero de membre"/>
        Ajouter un film a l'historique <input type="number" name="addmovie" placeholder="ID du film"/>

        <p></p>

        Ajouter une séancer <input type="number" name="idmovie" placeholder="ID du film"/>
                                    <input type="number" name="idroom" placeholder="ID de la salle"/>
                                    <input type="datetime-local" name="datebegin" placeholder="Date et heure de début"/>
                                    <input type="submit" value="Ajouter"/>
    </form>
    
    <hr>

    <?php
        //CONNECT DATABASE
        $username = 'Massi';
        $password = 'qa58WS05massinissa';
        try 
        {
            $data = new PDO("mysql:host=localhost;dbname=cinema", $username, $password);         
        }
        
        catch (PDOException $e) 
        {
            echo "Connection Failed." . $e->getMessage();
        }

        //GET VALUE
        $title = $_GET['titre'];
        $genre = $_GET['genre'];
        $distributeur = $_GET['distributeur'];
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $idmember = $_GET['idmember'];
        $addmovie = $_GET['addmovie'];
        $idmovie = $_GET['idmovie'];
        $idroom = $_GET['idroom'];
        $datebegin = $_GET['datebegin'];

         //RECHERCHE PAR NOM && DISTRIBUTEUR
        if(!empty($title) && !empty($distributeur))
        {
            $sqlcount = "SELECT COUNT(*) FROM movie";
            $stmtCount = $data->query($sqlCount);
            $totalResults = $stmtCount->fetch(PDO::FETCH_ASSOC);
    
            //TOTAL PAGES
            $totalPages = ceil($totalResults / $resultsPerPage);

            //SET PAGINATION
            $resultsparpage = 2;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $resultsparpage;

            $sqlND = "SELECT title, distributor.name AS distributeur FROM movie
                      JOIN distributor ON movie.id_distributor = distributor.id
                      WHERE distributor.name LIKE '%$distributeur%' AND title LIKE '%$title%'
                      LIMIT $resultsparpage OFFSET $offset";

            foreach($data -> query($sqlND) as $value)
            {
                echo $value['title'] . "<br>" . $value['distributeur'] . "<br>" . "<br>";
            }

             //PAGE PRÉCEDENTE
            echo "<div>";
            if ($page > 1) 
            {
                echo "<a href='?page=" . ($page - 1) . "'>Page précédente</a> ";
            }

            //PAGE SUIVANTE
            if ($page < $totalPages) 
            {
                echo "<a href='?page=" . ($page + 1) . "'>Page suivante</a>";
            }   
            echo "</div>";
        }

        //RECHERCHE PAR DISTRIBUTEUR
        elseif(!empty($distributeur))
        {
            $sqldistributeur = "SELECT title, distributor.name AS distributeur FROM movie
                                JOIN distributor ON movie.id_distributor = distributor.id
                                WHERE distributor.name LIKE '%$distributeur%'";
            foreach($data -> query($sqldistributeur) as $value)
            {
                echo $value['title'] . "<br>" . $value['distributeur'] . "<br>" . "<br>";
            }        
        }

        //RECHERCHE PAR NOM && GENRE
        elseif(!empty($title) && !empty($genre))
        {
            $sqlNG = "SELECT title, genre.name AS genre FROM movie
                      JOIN movie_genre ON movie.id = movie_genre.id_movie
                      JOIN genre ON movie_genre.id_genre = genre.id
                      WHERE title LIKE '%$title%' AND genre.id = '$genre'";
            foreach($data -> query($sqlNG) as $value)
            {
                echo $value['title'] . "<br>" . $value['genre'] . "<br>" . "<br>";
            }
        }

        //RECHERCHE PAR TITRE
        elseif(!empty($title))
        {
            $sqlcount = "SELECT COUNT(*) FROM movie";
            $stmtcount = $data->query($sqlcount);
            $totalresults = $stmtcount->fetch(PDO::FETCH_ASSOC);
    
            //TOTAL PAGES
            $totalpages = ceil($totalresults / $resultsparpage);

            //SET PAGINATION
            $resultsparpage = 2;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $resultsparpage;

            $sqlname = "SELECT title FROM movie WHERE title LIKE '%$title%'";
            foreach($data -> query($sqlname) as $value)
            {
                echo $value['title'] . "<br>";
            }
                        //PAGE PRÉCEDENTE
                        echo "<div>";
                        if ($page > 1) 
                        {
                            echo "<a href='?page=" . ($page - 1) . "'>Page précédente</a> ";
                        }
            
                        //PAGE SUIVANTE
                        if ($page < $totalpages) 
                        {
                            echo "<a href='?page=" . ($page + 1) . "'>Page suivante</a>";
                        }   
                        echo "</div>";
        }

        //RECHERCHE PAR GENRE
        elseif(!empty($genre))
        {
            $sqlgenre = "SELECT title, genre.name AS genre FROM movie
                         JOIN movie_genre ON movie.id = movie_genre.id_movie
                         JOIN genre ON movie_genre.id_genre = genre.id
                         WHERE genre.id = '$genre'";
            foreach($data -> query($sqlgenre) as $value)
            {
                echo $value['title'] . "<br>" . $value['genre'] . "<br>" . "<br>";
            }
        }

        //RECHERCHE PAR NOM/PRENOM UTILISATEUR
        if(!empty($nom) && !empty($prenom))
        {
            $sqlfullname = "SELECT lastname, firstname FROM user 
                            WHERE lastname LIKE '%$nom%'
                            AND firstname LIKE '%$prenom%'";
            foreach($data -> query($sqlfullname) as $value)
            {
                echo $value['lastname'] . "<br>" . $value['firstname'] . "<br>" . "<br>";
            }
        }

        //RECHERCHE PAR NOM UTILISATEUR
        elseif(!empty($nom))
        {
            $sqlnom = "SELECT lastname, firstname FROM user
                       WHERE lastname LIKE '%$nom%'";
            foreach($data -> query($sqlnom) as $value) 
            {
                echo $value['lastname'] . "<br>" . $value['firstname'] . "<br>" . "<br>";
            }
        }

        //RECHERCHE PAR PRENOM UTILISATEUR
        elseif(!empty($prenom))
        {
            $sqlprenom = "SELECT lastname, firstname FROM user
                          WHERE firstname LIKE '%$prenom%'";
            foreach($data -> query($sqlprenom) as $value) 
            {
                echo $value['lastname'] . "<br>" . $value['firstname'] . "<br>" . "<br>";
            }
        }

        //HISTORIQUE DE MEMBRE
        if(!empty($idmember))
        {
            $sqlhistorique = "SELECT title FROM movie 
                              JOIN membership_log ON membership_log.id_session = movie.id
                              WHERE membership_log.id_membership = '$idmember'";
                              echo "<h3>" . $idmember . "</h3>";
            foreach($data -> query($sqlhistorique) as $value)
            {
                echo $value['title'] . "<br>" . "<br>";
            }
        }

        //AJOUTER UN FILM A L'HISTORIQUE DE L'ABONNÉE
        elseif(!empty($idmember) && !empty($addmovie))
        {
            $sqladdmovieihisto = "INSERT INTO membership_log (id_membership, id_session)
                                  VALUES ('$idmember' , '$addmovie')
                                  SELECT title FROM movie 
                                  JOIN membership_log ON membership_log.id_session = movie.id 
                                  WHERE membership_log.id_membership = '$idmember';";
        }

        //AJOUT D'UNE SEANCE
        if(!empty($idmovie) && !empty($idroom) && !empty($datebegin))
        {
            $sqlsession = "INSERT INTO movie_schedule (id_movie, id_room, date_begin)
                           VALUES ('$idmovie' , '$idroom' , '$datebegin')";
        }
    ?>
</body>
</html>