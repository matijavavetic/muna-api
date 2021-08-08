<?php

namespace src\Business\Mappers\Film;

use JsonSerializable;

class FilmMapper implements JsonSerializable
{
    public function __construct(
        private string $title,
        private int $episodeId,
        private string $openingCrawl,
        private string $director,
        private string $producer,
        private string $releaseDate,
        private array $species,
        private array $vehicles,
        private array $starships,
        private array $characters,
        private array $planets,
        private string $url,
        private string $created,
        private string $edited
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getEpisodeId(): int
    {
        return $this->episodeId;
    }

    public function getOpeningCrawl(): string
    {
        return $this->openingCrawl;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function getProducer(): string
    {
        return $this->producer;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getSpecies(): array
    {
        return $this->species;
    }

    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function getStarships(): array
    {
        return $this->starships;
    }

    public function getCharacters(): array
    {
        return $this->characters;
    }

    public function getPlanets(): array
    {
        return $this->planets;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function getEdited(): string
    {
        return $this->edited;
    }

    public function jsonSerialize()
    {
        $output = [
            'title' => $this->getTitle(),
            'episodeId' => $this->getEpisodeId(),
            'openingCrawl' => $this->getOpeningCrawl(),
            'director' => $this->getDirector(),
            'producer' => $this->getProducer(),
            'releaseDate' => $this->getReleaseDate(),
            'species' => $this->getSpecies(),
            'vehicles' => $this->getVehicles(),
            'starships' => $this->getStarships(),
            'characters' => $this->getCharacters(),
            'planets' => $this->getPlanets(),
            'url' => $this->getUrl(),
            'created' => $this->getCreated(),
            'edited' => $this->getEdited()
        ];

        return $output;
    }
}