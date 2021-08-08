<?php

namespace Tests\Integration;

use Tests\TestCase;
use src\Business\Services\PlanetService;
use src\Data\Repositories\Contracts\PlanetRepositoryInterface;
use src\Business\Mappers\Planet\Request\PlanetListRequestMapper;
use src\Business\Mappers\Planet\Response\PlanetListResponseMapper;
use src\Data\Contracts\StorageInterface;
use src\Data\Enums\SWApiEndpoint;

/**
 * @group integration
 */
class PlanetServiceTest extends TestCase
{
    public function testListActionExpectListResponseMapper(): void
    {
        $planetRepository = $this->app->make(PlanetRepositoryInterface::class);
        $storage = $this->app->make(StorageInterface::class);

        $planetService = new PlanetService($planetRepository);

        $requestMapper = new PlanetListRequestMapper();
        $requestMapper->setCreatedAfter('2014-04-12');

        $responseMapper = $planetService->list($requestMapper);

        $decodeResponseMapper = json_decode(json_encode($responseMapper), true);

        $fetchPlanets = $storage->fetch(SWApiEndpoint::fromValue(SWApiEndpoint::PLANETS));

        $this->assertInstanceOf(PlanetListResponseMapper::class, $responseMapper);
        $this->assertEquals($decodeResponseMapper[0]['name'], $fetchPlanets[0]['name']);
    }
}