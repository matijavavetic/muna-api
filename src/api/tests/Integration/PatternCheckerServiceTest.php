<?php

namespace Tests\Integration;

use src\Business\Helpers\Contracts\PatternCheckerInterface;
use src\Business\Mappers\Stat\Request\StatRequestMapper;
use src\Business\Mappers\Stat\Response\StatResponseMapper;
use src\Business\Services\PatternCheckerService;
use src\Data\Repositories\Contracts\CacheInterface;
use src\Data\Repositories\Contracts\RepositoryInterface;
use Tests\AbstractTestCase;

/**
 * @group integration
 */
class PatternCheckerServiceTest extends AbstractTestCase
{
    public function testStatActionExpectStatResponseMapper(): void
    {
        $patternCheckerInterface = $this->app->make(PatternCheckerInterface::class);
        $repositoryInterface = $this->app->make(RepositoryInterface::class);
        $cacheInterface = $this->app->make(CacheInterface::class);

        $patternCheckerService = new PatternCheckerService(
            $patternCheckerInterface,
            $repositoryInterface,
            $cacheInterface
        );

        $requestMapper = new StatRequestMapper($this->randomUserUuid);

        $responseMapper = $patternCheckerService->stat($requestMapper);

        $decodeResponseMapper = json_decode(json_encode($responseMapper), true);

        $info = $cacheInterface->findInfoByUserId($this->randomUserUuid);

        $this->assertInstanceOf(StatResponseMapper::class, $responseMapper);
        $this->assertEquals($decodeResponseMapper['state'], $info->getSolved() ? 'true' : 'false');
    }
}