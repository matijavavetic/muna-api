<?php

namespace Tests\Integration;

use src\Business\Mappers\Film\Request\CharacterFilmListRequestMapper;
use src\Business\Mappers\Film\Response\CharacterFilmListResponseMapper;
use Tests\TestCase;
use src\Data\Repositories\Contracts\PersonRepositoryInterface;
use src\Data\Repositories\Contracts\FilmRepositoryInterface;
use src\Business\Services\FilmService;
use src\Data\Enums\SWApiEndpoint;
use src\Data\Contracts\StorageInterface;

/**
 * @group integration
 */
class FilmServiceTest extends TestCase
{
    public function testCharacterFilmListActionExpectListResponseMapper(): void
    {
        $personRepository = $this->app->make(PersonRepositoryInterface::class);
        $filmRepository = $this->app->make(FilmRepositoryInterface::class);
        $storage = $this->app->make(StorageInterface::class);

        $filmService = new FilmService(
            $filmRepository, 
            $personRepository
        );

        $characterName = 'Luke Skywalker';

        $requestMapper = new CharacterFilmListRequestMapper($characterName);

        $responseMapper = $filmService->characterFilmList($requestMapper);

        $decodeResponseMapper = json_decode(json_encode($responseMapper), true);

        $searchTitle = 'A New Hope';
        $fetchFilm = $storage->fetch(SWApiEndpoint::fromValue(SWApiEndpoint::FILMS), $searchTitle);

        $this->assertEquals($decodeResponseMapper[0]['title'], $fetchFilm[0]['title']);
        $this->assertInstanceOf(CharacterFilmListResponseMapper::class, $responseMapper);
    }
}