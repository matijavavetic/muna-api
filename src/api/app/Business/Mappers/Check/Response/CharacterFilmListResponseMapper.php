<?php

namespace src\Business\Mappers\Film\Response;

use JsonSerializable;
use src\Data\Mappers\FilmMapperCollection;

class CharacterFilmListResponseMapper implements JsonSerializable
{
    private FilmMapperCollection $filmMappers;

    public function getFilmMappers(): FilmMapperCollection
    {
        return $this->filmMappers;
    }

    public function setFilmMappers(FilmMapperCollection $filmMappers): void
    {
        $this->filmMappers = $filmMappers;
    }

    public function toArray()
    {
        return $this->filmMappers;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}