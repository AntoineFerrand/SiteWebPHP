<?php

class Admin
{
    private $id;
    private $pseudo;
    private $password;

    public function __construct(int $identifiant, string $pseudonyme, string $mdp)
    {
        $this->id=$identifiant;
        $this->pseudo=$pseudonyme;
        $this->password=$mdp;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }



    public function __toString():string
    {
        return $this->id.' '.$this->pseudo;
    }

}