<?php


class News
{
    private $url;
    private $nom;
    private $description;
    private $date;

    public function __construct(string $nom, string $desc, string $date, string $url)
    {
        $this->nom=$nom;
        $this->description=$desc;
        $this->date=$date;
        $this->url=$url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function __toString():string
    {
        return $this->nom.' '.$this->description.' '.$this->date.' '.$this->url;
    }

}