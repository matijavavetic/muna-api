<?php

namespace Tests\Unit;

use src\Business\Services\FilmService;
use src\Data\Enums\SWApiEndpoint;
use src\Data\Repositories\Contracts\FilmRepositoryInterface;
use src\Data\Repositories\Contracts\PersonRepositoryInterface;
use src\Data\Factories\PersonEntityFactory;
use src\Data\Factories\FilmEntityFactory;
use src\Data\Contracts\StorageInterface;
use Tests\Unit\AbstractUnitTest;
use src\Business\Exceptions\NotFoundException;
use src\Business\Mappers\Film\Request\CharacterFilmListRequestMapper;
use src\Data\Mappers\FilmEntityCollection;

/**
 * @group unit
 */
class FilmServiceTest extends AbstractUnitTest
{
    /** @var FilmRepositoryInterface */
    private $filmRepository;
    /** @var PersonRepositoryInterface */
    private $personRepository;

    private FilmService $filmService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->filmRepository = $this->prophesize(FilmRepositoryInterface::class);
        $this->personRepository = $this->prophesize(PersonRepositoryInterface::class);
        $this->filmService = new FilmService(
            $this->filmRepository->reveal(),
            $this->personRepository->reveal()
        );
    }

    public function testListActionReturnsSuccessAndListResponseMapper(): void
    {
        $this->personRepository
            ->findOneByName($this->person->getName())
            ->shouldBeCalledOnce()
            ->willReturn($this->person);  

        $this->filmRepository
            ->findAllByCharacterUrl($this->person->getUrl())
            ->shouldBeCalledOnce()
            ->willReturn(new FilmEntityCollection([$this->film]));
            
        $this->filmService->characterFilmList(new CharacterFilmListRequestMapper($this->person->getName()));
    }

    public function testWillThrowExceptionIfNoCharacterFound(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('No characters found.');

        $name = 'Character name that definitely does not exist';

        $this->personRepository
            ->findOneByName($name)
            ->shouldBeCalledOnce()
            ->willReturn(null);
            
        $this->filmService->characterFilmList(new CharacterFilmListRequestMapper($name));     
    }

    public function testWillThrowExceptionIfEntityCollectionEmpty(): void
    {
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('No films found.');

        $this->personRepository
            ->findOneByName($this->person->getName())
            ->shouldBeCalledOnce()
            ->willReturn($this->person); 

        $this->filmRepository
            ->findAllByCharacterUrl($this->person->getUrl())
            ->shouldBeCalledOnce()
            ->willReturn(new FilmEntityCollection());
            
        $this->filmService->characterFilmList(new CharacterFilmListRequestMapper($this->person->getName()));     
    }
}