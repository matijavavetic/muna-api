<?php

namespace Tests\Functional;

use Tests\TestCase;
use src\Business\Exceptions\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 */
class PlanetListEndpointTest extends TestCase
{
    const ENDPOINT = 'http://127.0.0.1/api/planet.list';

    public function testSendValidDataExceptOkResponse(): void
    {
        $response = $this->json('POST', self::ENDPOINT);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['name' => 'Tatooine']);
    }

    public function testNoPlanetsFoundExpectException(): void
    { 
        $this->withoutExceptionHandling();
        
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('No planets found.');

        $payload = [
            'createdAfter' => '9999-01-01'
        ];

        $this->json('POST', self::ENDPOINT, $payload);
    }
}
