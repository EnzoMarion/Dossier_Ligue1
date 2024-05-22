<?php
require_once('Club.php');

class GestionClub {
    private PDO $connexion;

    public function __construct(PDO $connexion) {
        $this->connexion = $connexion;
    }

    public function getListeClub(): array {
        $query = "SELECT * FROM club";
        $result = $this->connexion->query($query);
        $clubs = [];

        if ($result) {
            foreach ($result as $row) {
                $club = new Club(
                    $row['id_club'],
                    $row['nom_club'],
                    $row['id_stade'],
                    $row['ville'],
                    $row['manager_club'],
                    $row['fondation_club'],
                    $row['logo_club']
                );
                $clubs[] = $club;
            }
        }

        return $clubs;
    }
}
?>
