<?php
require 'database.php';
    class Utilisateur
    {
        private $nom;
        private $prenom;
        private $email;
        private $mdp;
        private $birthdate;
        private $genre;
        private $ville;
        private $loisir;

        public function __construct($nom, $prenom, $email, $mdp, $birthdate, $genre, $ville, $loisir)
        {
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->email=$email;
            $this->mdp=$mdp;
            $this->birthdate=$birthdate;
            $this->genre=$genre;
            $this->ville=$ville;
            $this->loisir=$loisir;
        }

        //GET
        public function getNom()
        {
            return $this->nom;
        }

        public function getPrenom()
        {
            return $this->prenom;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getMdp()
        {
            return $this->mdp;
        }

        public function getBirthdate()
        {
            return $this->birthdate;
        }

        public function getGenre()
        {
            return $this->genre;
        }

        public function getVille()
        {
            return $this->ville;
        }

        public function getLoisir()
        {
            return $this->loisir;
        }

        //SET
        public function setNom($nom)
        {
            $this->nom=$nom;
        }

        public function setPrenom($prenom)
        {
            $this->prenom=$prenom;
        }

        public function setEmail($email)
        {
            $this->email=$email;
        }

        public function setMdp($mdp)
        {
            $this->mdp=$mdp;
        }

        public function setBirthdate($birthdate)
        {
            $this->birthdate=$birthdate;
        }

        public function setGenre($genre)
        {
            $this->genre=$genre;
        }

        public function setVille($ville)
        {
            $this->ville=$ville;
        }

        public function setLoisir($loisir)
        {
            $this->loisir=$loisir;
        }
        
        //FILTRE EMAIL
        public function mailValide()
        {
            return filter_var($this->email, FILTER_VALIDATE_EMAIL);
        }

        //FILTRE AGE
        // public function verifAge()
        // {

        // }

        //INSCRIPTION
        public function inscription()
        {
            return !empty($this->nom) && !empty($this->prenom) && !empty($this->email) && !empty($this->mdp) && !empty($this->birthdate) && !empty($this->genre) && !empty($this->ville) && !empty($this->loisir);
        }
        
        //CONNEXION
        public function connexion()
        {
            return !empty($this->email) && !empty($this->mdp);
        }
    }

    $utilisateur1 = NULL;

    if(isset($_POST['signup']))
    {
        $nom1=$_POST['nom'];
        $prenom1=$_POST['prenom'];
        $email1=$_POST['email'];
        $mdp1=md5($_POST['mdp']);
        $birthdate1=$_POST['birthdate'];
        $genre1=$_POST['genre'];
        $ville1=$_POST['ville'];
        $loisir1=$_POST['loisir'];

        $utilisateur1 = new Utilisateur($nom1, $prenom1, $email1, $mdp1, $birthdate1, $genre1, $ville1, $loisir1);

        if(!$utilisateur1->inscription())
        {
            echo "Veuillez remplir tous les champs";
        } 
        elseif(!$utilisateur1->mailValide())
        {
            echo "Veuillez saisir un email valide";
        }
        // elseif(!$utilisateur1->verifAge())
        // {
        //     echo "Vous n'avez pas l'age minimum requis";
        // }
        else
        {
            $sql = "INSERT INTO user (nom, prenom, email, mdp, date_de_naissance, genre, ville, loisir) VALUES (:nom, :prenom, :email, :mdp, :date_de_naissance, :genre, :ville, :loisir)";
            $signup = $data->prepare($sql);

            $signup->bindParam(':nom' , $nom1);
            $signup->bindParam(':prenom' , $prenom1);
            $signup->bindParam(':email' , $email1);
            $signup->bindParam(':mdp' , $mdp1);
            $signup->bindParam(':date_de_naissance' , $birthdate1);
            $signup->bindParam(':genre' , $genre1);
            $signup->bindParam(':ville' , $ville1);
            $signup->bindParam(':loisir' , $loisir1);

            $signup->execute();
        }
    }


    if(isset($_POST['login']))
    {
        if(!$utilisateur1->connexion())
        {
            echo "Veuillez remplir tous les champs";
        }
        elseif(!$utilisateur1->mailValide())
        {
            echo "Veuillez saisir un email valide";
        }
        else
        {
            $reqsql = "SELECT * FROM meetic WHERE email = '%$email1%' AND mdp = '$mdp1'";
            $result = $data->query($reqsql);
            $liste = $result->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    ?>