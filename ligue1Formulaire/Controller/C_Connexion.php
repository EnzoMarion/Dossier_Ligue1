<?php
session_start();
include_once("header.php");
require_once(__DIR__ . '/../Model/GestionUser.php');

class C_Connexion {

    public function run() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';

            try {
                $cnx = new PDO($dsn);
                $gestionUser = new GestionUser($cnx);
                $user = $gestionUser->getUserByEmail($email);

                if ($user && password_verify($password, $user['password_uti'])) {
                    $_SESSION["user_id"] = $user['id_uti'];
                    $_SESSION["user_nom"] = $user['nom_uti'];
                    $_SESSION["user_prenom"] = $user['prenom_uti'];
                    header("Location: Accueil");
                    exit();
                } else {
                    echo "Email ou mot de passe incorrect.";
                }

            } catch (PDOException $e) {
                echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
            }
        }

        include_once(__DIR__ . '/../View/Connexion.php');
    }
}

$connexionController = new C_Connexion();
$connexionController->run();
?>
