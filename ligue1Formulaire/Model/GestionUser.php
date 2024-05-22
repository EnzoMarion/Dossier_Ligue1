<?php
require_once(__DIR__ . '/User.php');
require_once('Club.php');

class GestionUser {
    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function getUserByEmail($email) {
        try {
            $query = "SELECT * FROM utilisateur WHERE mail_uti = :email";
            $stmt = $this->cnx->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de la récupération de l\'utilisateur : ' . $e->getMessage());
        }
    }

    public function getUserById($id) {
        try {
            $query = "SELECT * FROM utilisateur WHERE id_uti = :id";
            $stmt = $this->cnx->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new User($row['id_uti'], $row['nom_uti'], $row['prenom_uti'], $row['mail_uti']);
            }

            return null;
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de la récupération de l\'utilisateur : ' . $e->getMessage());
        }
    }

    public function getClubsFavoris($id) {
    try {
        $query = "SELECT c.* FROM club c
                  INNER JOIN s_abonner s ON c.id_club = s.id_club
                  WHERE s.id_uti = :id";
        $stmt = $this->cnx->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clubs = [];
        foreach ($result as $row) {
            $clubs[] = new Club(
                $row['id_club'],
                $row['nom_club'],
                $row['id_stade'],
                $row['ville'],
                $row['manager_club'],
                $row['fondation_club'],
                $row['logo_club']
            );
        }

        return $clubs;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération des clubs favoris : ' . $e->getMessage());
    }
}

/* public function updateUserClubs($userId, $clubIds) {
    try {
        $query = "DELETE FROM s_abonner WHERE id_uti = :userId";
        $stmt = $this->cnx->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        foreach ($clubIds as $clubId) {
            $query = "INSERT INTO s_abonner (id_uti, id_club) VALUES (:userId, :clubId)";
            $stmt = $this->cnx->prepare($query);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':clubId', $clubId);
            $stmt->execute();
        }
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la mise à jour des clubs abonnés : ' . $e->getMessage());
    }
}*/
}
?>
