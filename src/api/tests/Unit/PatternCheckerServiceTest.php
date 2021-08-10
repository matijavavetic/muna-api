<?php

namespace Tests\Unit;

use Ramsey\Uuid\Uuid;
use src\Business\Mappers\Starship\Request\StarshipListRequestMapper;
use src\Business\Services\StarshipService;
use src\Data\Enums\SWApiEndpoint;
use src\Data\Mappers\StarshipEntityCollection;
use src\Data\Repositories\Contracts\StarshipRepositoryInterface;
use src\Data\Factories\StarshipEntityFactory;
use src\Data\Contracts\StorageInterface;
use Tests\Unit\AbstractUnitTest;
use src\Business\Exceptions\NotFoundException;
use src\Business\Helpers\Contracts\PatternCheckerInterface;
use src\Business\Mappers\Stat\Request\StatRequestMapper;
use src\Business\Services\PatternCheckerService;
use src\Business\Starship\Response\StarshipListResponseMapper;
use src\Data\Entities\Info;
use src\Data\Repositories\Contracts\CacheInterface;
use src\Data\Repositories\Contracts\RepositoryInterface;
use Tests\AbstractTestCase;

/**
 * @group unit
 */
class PatternCheckerServiceTest extends AbstractTestCase
{
    /** @var PatternCheckerInterface */
    private $patternCheckerInterface;
    /** @var RepositoryInterface */
    private $repositoryInterface;
    /** @var CacheInterface */
    private $cacheInterface;

    private PatternCheckerService $patternCheckerService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->patternCheckerInterface = $this->prophesize(PatternCheckerInterface::class);
        $this->repositoryInterface = $this->prophesize(RepositoryInterface::class);
        $this->cacheInterface = $this->prophesize(CacheInterface::class);

        $this->patternCheckerService = new PatternCheckerService(
            $this->patternCheckerInterface->reveal(),
            $this->repositoryInterface->reveal(),
            $this->cacheInterface->reveal()
        );
    }

    public function testStatActionReturnsSuccessAndStatResponseMapper(): void
    {
        $this->cacheInterface
            ->findInfoByUserId($this->randomUserUuid)
            ->shouldBeCalledOnce()
            ->willReturn($this->getTestInfoFromCache());  
            
        $this->patternCheckerService->stat(
            new StatRequestMapper($this->randomUserUuid)
        );
    }

    public function testWillThrowExceptionIfInfoEntityNotFound(): void
    {
        $randomUuid = Uuid::uuid4();
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('No game info related to your id found.');

        $this->cacheInterface
            ->findInfoByUserId($randomUuid)
            ->shouldBeCalledOnce()
            ->willReturn(null);  
            
        $this->patternCheckerService->stat(
            new StatRequestMapper($randomUuid)
        );        
    }
}