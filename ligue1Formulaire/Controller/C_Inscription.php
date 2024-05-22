<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../css/style_inscription.css">
</head>

<body>

<?php

include_once("header.php");
require_once(__DIR__ . '/../Model/GestionClub.php');

class C_Inscription {

    public function run() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $motdepasse = password_hash($_POST["motdepasse"], PASSWORD_BCRYPT);
            $confirmpassword = $_POST["confirmpassword"];

            if (password_verify($confirmpassword, $motdepasse)) {
                $sexe = $_POST["sexe"];
                $clubsFavoris = isset($_POST["clubs"]) ? $_POST["clubs"] : array();

                $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';

                try {
                    $cnx = new PDO($dsn);

                    $clubIDs = array();
                    foreach ($clubsFavoris as $clubNom) {
                        $query = "SELECT id_club FROM club WHERE nom_club = ?";
                        $stmt = $cnx->prepare($query);
                        $stmt->execute([$clubNom]);
                        $clubID = $stmt->fetchColumn();
                        if ($clubID) {
                            $clubIDs[] = $clubID;
                        }
                    }

                    if (!empty($clubIDs)) {
                        $query = "INSERT INTO utilisateur (id_club, nom_uti, prenom_uti, sexe_uti, password_uti, mail_uti, date_inscription) 
                                  VALUES (?, ?, ?, ?, ?, ?, now())";
                        $stmt = $cnx->prepare($query);
                        $stmt->execute([$clubIDs[0], $nom, $prenom, $sexe, $motdepasse, $email]);

                        $userId = $cnx->lastInsertId('utilisateur_id_uti_seq');

                        foreach ($clubIDs as $clubID) {
                            $query = "INSERT INTO s_abonner (id_uti, id_club) VALUES (?, ?)";
                            $stmt = $cnx->prepare($query);
                            $stmt->execute([$userId, $clubID]);
                        }

                        echo "Inscription réussie.";
                        exit();
                    } else {
                        echo "<br><br>Aucun club favori validé, Veuillez choisir un club !";
                    }

                } catch (PDOException $e) {
                    if ($e->getCode() == '23505' && strpos($e->getMessage(), 'unique_email') !== false) {
                    echo "<br><br>L'adresse email que vous avez fournie est déjà utilisée. Veuillez utiliser une autre adresse email.";
                    } else {
                        echo '<br><br>Une erreur est survenue lors de la connexion à la base de données.';
                    }
                }
            } else {
                echo '<script>alert("Les mots de passe ne correspondent pas.");</script>';
            }
        }

        $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';

        try {
            $cnx = new PDO($dsn);
        } catch (PDOException $e) {
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
            exit();
        }

        $gestionClub = new GestionClub($cnx);
        $clubs = $gestionClub->getListeClub();

        include_once(__DIR__ . '/../View/Inscription.php');
    }
}

$inscriptionController = new C_Inscription();
$inscriptionController->run();
?>

</body>
</html>
