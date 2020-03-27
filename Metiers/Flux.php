<?php


class Flux
{
    private $url;

    public function __construct(string $url)
    {
        $this->url=$url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }
}