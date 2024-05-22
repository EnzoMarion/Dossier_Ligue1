<?php

class User {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;

    public function __construct(int $id, string $nom, string $prenom, string $email) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getEmail(): string {
        return $this->email;
    }
}
