<?

namespace Tests;

use DateTime;
use Faker\Factory as FakerFactory;
use Faker\Generator;
use Prophecy\PhpUnit\ProphecyTrait;
use Ramsey\Uuid\Uuid;
use src\Data\Entities\HistoryItem;
use src\Data\Entities\Info;
use src\Data\Repositories\Contracts\CacheInterface;
use src\Data\Repositories\Contracts\RepositoryInterface;
use Tests\TestCase;

abstract class AbstractTestCase extends TestCase
{
    use ProphecyTrait;

    protected Generator $faker;
    private CacheInterface $cacheInterface;
    private RepositoryInterface $repositoryInterface;
    protected string $randomUserUuid;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = FakerFactory::create();
        $this->cacheInterface = $this->app->make(CacheInterface::class);
        $this->repositoryInterface = $this->app->make(RepositoryInterface::class);
        $this->randomUserUuid = Uuid::uuid4();

        $this->createInfoWithHistoryItemAndStoreIt();
    }

    private function createInfoWithHistoryItemAndStoreIt(): void
    {
        $historyItem = new HistoryItem();
        $historyItem
            ->setTime(new DateTime('now'))
            ->setValue($this->faker->word());

        $info = new Info();
        $info
            ->setSolved(true)
            ->setUserId($this->randomUserUuid)
            ->addHistoryItem($historyItem);

        $this->repositoryInterface->save($info);
        $this->repositoryInterface->save($historyItem);

        $this->cacheInterface->updateInfoState(
            $this->randomUserUuid,
            'false'
        );

        $this->cacheInterface->attachHistoryItemToInfo(
            $this->randomUserUuid,
            $historyItem
        );
    }

    protected function getTestInfoFromCache(): Info
    {
        return $this->cacheInterface->findInfoByUserId($this->randomUserUuid);
    }
}