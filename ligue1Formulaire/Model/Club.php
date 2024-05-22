<?php 
class Club {
    private int $id;
    private string $nomClub;
    private int $idStade;
    private string $ville;
    private string $managerClub;
    private string $fondationClub;
    private string $logoClub;

    public function __construct(int $id, string $nomClub, int $idStade, string $ville, string $managerClub, string $fondationClub, string $logoClub) {
        $this->id = $id;
        $this->nomClub = $nomClub;
        $this->idStade = $idStade;
        $this->ville = $ville;
        $this->managerClub = $managerClub;
        $this->fondationClub = $fondationClub;
        $this->logoClub = $logoClub;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNomClub(): string {
        return $this->nomClub;
    }

    public function setNomClub(string $nomClub): void {
        $this->nomClub = $nomClub;
    }

    public function getIdStade(): int {
        return $this->idStade;
    }

    public function setIdStade(int $idStade): void {
        $this->idStade = $idStade;
    }

    public function getVille(): string {
        return $this->ville;
    }

    public function setVille(string $ville): void {
        $this->ville = $ville;
    }

    public function getManagerClub(): string {
        return $this->managerClub;
    }

    public function setManagerClub(string $managerClub): void {
        $this->managerClub = $managerClub;
    }

    public function getFondationClub(): string {
        return $this->fondationClub;
    }

    public function setFondationClub(string $fondationClub): void {
        $this->fondationClub = $fondationClub;
    }

    public function getLogoClub(): string {
        return $this->logoClub;
    }

    public function setLogoClub(string $logoClub): void {
        $this->logoClub = $logoClub;
    }
}
?>
