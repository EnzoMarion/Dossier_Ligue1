<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
session_start();
include_once("header.php");
require_once(__DIR__ . '/../Model/GestionUser.php');

class C_Profil {

    public function run() {
        if (!isset($_SESSION["user_id"])) {
            header("Location: Connexion");
            exit();
        }

        $userId = $_SESSION["user_id"];

        $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';

        try {
            $cnx = new PDO($dsn);
            $gestionUser = new GestionUser($cnx);
            $user = $gestionUser->getUserById($userId);

            if ($user) {
                $clubsFavoris = $gestionUser->getClubsFavoris($userId);
                include_once(__DIR__ . '/../View/Profil.php');
            } else {
                echo "Utilisateur non trouvé.";
            }

        } catch (PDOException $e) {
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
        }
    }
}

$profilController = new C_Profil();
$profilController->run();
?>
