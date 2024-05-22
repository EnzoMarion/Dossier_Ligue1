<?php
class Commentaire {
    private int $idCommentaire;
    private string $strCommentaire;
    private string $nom;
    private int $idNews;
    private int $idUti;

    public function __construct(string $strCommentaire, string $nom, int $idNews, int $idUti, int $idCommentaire = 0) {
        $this->idCommentaire = $idCommentaire;
        $this->strCommentaire = $strCommentaire;
        $this->nom = $nom;
        $this->idNews = $idNews;
        $this->idUti = $idUti;
    }

    public function getIdCommentaire(): int {
        return $this->idCommentaire;
    }

    public function getStrCommentaire(): string {
        return $this->strCommentaire;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getIdNews(): int {
        return $this->idNews;
    }

    public function getIdUti(): int {
        return $this->idUti;
    }
}
?>
