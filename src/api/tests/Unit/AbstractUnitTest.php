<?

namespace Tests\Unit;

use Tests\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use src\Data\Factories\PersonEntityFactory;
use src\Data\Factories\FilmEntityFactory;
use src\Data\Factories\StarshipEntityFactory;
use src\Data\Entities\Contracts\PersonEntityInterface;
use src\Data\Entities\Contracts\FilmEntityInterface;
use src\Data\Entities\Contracts\StarshipEntityInterface;

abstract class AbstractUnitTest extends TestCase
{
    use ProphecyTrait;

    protected PersonEntityInterface $person;
    protected FilmEntityInterface $film;
    protected StarshipEntityInterface $starship;

    protected function setUp(): void
    {
        parent::setUp();

        $this->person = $this->getPerson();
        $this->film = $this->getFilm();
        $this->starship = $this->getStarship();
    }

    private function getPerson(): PersonEntityInterface
    {
        $data = [
            "name" => "Luke Skywalker",
            "height" => "172",
            "mass" => "77",
            "hair_color" => "blond",
            "skin_color" => "fair",
            "eye_color" => "blue",
            "birth_year" => "19BBY",
            "gender" => "male",
            "homeworld" => "https://swapi.dev/api/planets/1/",
            "films" => [
                "https://swapi.dev/api/films/2/",
            ],
            "species" => [
                "https://swapi.dev/api/species/1/"
            ],
            "vehicles" => [
                "https://swapi.dev/api/vehicles/14/",
            ],
            "starships" => [
                "https://swapi.dev/api/starships/12/",
            ],
            "created" => "2014-12-09T13:50:51.644000Z",
            "edited" => "2014-12-20T21:17:56.891000Z",
            "url" => "https://swapi.dev/api/people/1/"
        ];

        $person = PersonEntityFactory::make($data);

        return $person;
    }

    private function getFilm(): FilmEntityInterface
    {
        $data = [
            "characters" => [
                "https://swapi.dev/api/people/1/",
            ],
            "created" => "2014-12-10T14:23:31.880000Z",
            "director" => "George Lucas",
            "edited" => "2014-12-12T11:24:39.858000Z",
            "episode_id" => 4,
            "opening_crawl" => "It is",
            "planets" => [
                "https://swapi.dev/api/planets/1/",
            ],
            "producer" => "Gary Kurtz, Rick McCallum",
            "release_date" => "1977-05-25",
            "species" => [
                "https://swapi.dev/api/species/1/",
            ],
            "starships" => [
                "https://swapi.dev/api/starships/2/",
            ],
            "title" => "A New Hope",
            "url" => "https://swapi.dev/api/films/1/",
            "vehicles" => [
                "https://swapi.dev/api/vehicles/4/"
            ]
        ];

        $film = FilmEntityFactory::make($data);

        return $film;
    }

    private function getStarship(): StarshipEntityInterface
    {
        $data = [
            "name" => "CR90 corvette",
            "model" => "CR90 corvette",
            "manufacturer" => "Corellian Engineering Corporation",
            "cost_in_credits" => "3500000",
            "length" => "150",
            "max_atmosphering_speed" => "950",
            "crew" => "30-165",
            "passengers" => "600",
            "cargo_capacity" => "3000000",
            "consumables" => "1 year",
            "hyperdrive_rating" => "2.0",
            "MGLT" => "60",
            "starship_class" => "corvette",
            "pilots" => [
                "One"
            ],
            "films" => [
                "http://swapi.dev/api/films/1/"
            ],
            "created" => "2014-12-10T14:20:33.369000Z",
            "edited" => "2014-12-20T21:23:49.867000Z",
            "url" => "http://swapi.dev/api/starships/2/"
        ];

        $starship = StarshipEntityFactory::make($data);

        return $starship;
    }
}