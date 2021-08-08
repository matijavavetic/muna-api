<?php

namespace Tests\Functional;

use Tests\TestCase;
use src\Business\Exceptions\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group functional
 */
class StarshipListEndpointTest extends TestCase
{
    const ENDPOINT = 'http://127.0.0.1/api/starship.list';

    public function testSendValidDataExceptOkResponse()
    {
        $response = $this->json('POST', self::ENDPOINT);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['name' => 'Droid control ship']);
    }

    public function testNoStarshipsFoundExpectException()
    { 
        $this->withoutExceptionHandling();
        
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('No starships found.');

        $payload = [
            'passengers' => 999999999999
        ];

        $this->json('POST', self::ENDPOINT, $payload);
    }
}
