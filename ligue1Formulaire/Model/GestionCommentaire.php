<?php
require_once("Commentaire.php");

class GestionCommentaire {
    private PDO $connexion;

    public function __construct(PDO $connexion) {
        $this->connexion = $connexion;
    }

    public function ajouterCommentaire(Commentaire $commentaire): bool {
        try {
            $query = "INSERT INTO commentaire (str_commentaire, nom, id_news, id_uti) VALUES (:str_commentaire, :nom, :id_news, :id_uti)";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindValue(':str_commentaire', $commentaire->getStrCommentaire());
            $stmt->bindValue(':nom', $commentaire->getNom());
            $stmt->bindValue(':id_news', $commentaire->getIdNews());
            $stmt->bindValue(':id_uti', $commentaire->getIdUti());
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de l\'ajout du commentaire : ' . $e->getMessage());
        }
    }
}
?>
