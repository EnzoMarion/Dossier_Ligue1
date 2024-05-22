<?php
session_start();
require_once(__DIR__ . '/../Model/GestionCommentaire.php');
require_once(__DIR__ . '/../Model/Commentaire.php');

class C_Commentaire {

    public function run() {
        header('Content-Type: application/json');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $strCommentaire = $_POST['nouveau_commentaire'];
            $idNews = $_POST['id_news'];
            $nom = $_SESSION['user_nom'] ?? 'Anonyme';
            $idUti = $_SESSION['user_id'] ?? null;

            if ($idUti === null) {
                echo json_encode(["error" => "Vous devez être connecté pour poster un commentaire."]);
                exit();
            }

            $dsn = 'pgsql:host=localhost;dbname=backup_ligue;user=postgres;password=coucu;port=5432';

            try {
                $cnx = new PDO($dsn);
                $gestionCommentaire = new GestionCommentaire($cnx);
                $commentaire = new Commentaire($strCommentaire, $nom, $idNews, $idUti);
                if ($gestionCommentaire->ajouterCommentaire($commentaire)) {
                    echo json_encode(["success" => "Commentaire ajouté avec succès!"]);
                } else {
                    echo json_encode(["error" => "Erreur lors de l'ajout du commentaire."]);
                }
                exit();
            } catch (PDOException $e) {
                echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
            } catch (Exception $e) {
                echo json_encode(['error' => 'Erreur : ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(["error" => "Méthode non autorisée."]);
        }
    }
}

$commentaireController = new C_Commentaire();
$commentaireController->run();
?>
