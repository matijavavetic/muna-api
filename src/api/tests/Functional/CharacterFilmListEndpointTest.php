<?php

namespace Tests\Functional;

use Tests\TestCase;
use src\Business\Exceptions\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 */
class CharacterFilmListEndpointTest extends TestCase
{
    const ENDPOINT = 'http://127.0.0.1/api/character.film.list';

    public function testSendValidDataExceptOkResponse(): void
    {
        $payload = [
            'characterName' => 'Luke Skywalker'
        ];

        $response = $this->json('POST', self::ENDPOINT, $payload);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['title' => 'A New Hope']);
    }

    public function testNoCharacterFoundExpectExceptionThrown(): void
    { 
        $this->withoutExceptionHandling();
        
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('No characters found.');

        $payload = [
            'characterName' => "Character name that definitely does not exist"
        ];

        $this->json('POST', self::ENDPOINT, $payload);
    }
}
