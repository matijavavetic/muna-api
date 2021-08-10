<?php

namespace Tests\Functional;

use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;
use Tests\AbstractTestCase;

/**
 * @group functional
 */
class CheckEndpointTest extends AbstractTestCase
{
    private string $endpoint;

    protected function setUp(): void
    {
        parent::setUp();

        $this->endpoint = Config::get('app.url') . '/api/check';
    }

    public function testSendValidDataExpectOkResponse(): void
    {
        $payload = [
            'value' => 'DEADBEEF!'
        ];

        $response = $this->json('POST', $this->endpoint, $payload);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertSee('true');
    }

    public function testSendValueOverMaxAllowedCharsExpectBadRequestError(): void
    {
        $payload = [
            'value' => $this->faker->text(200)
        ];

        $response = $this->json('POST', $this->endpoint, $payload);

        $response
            ->assertStatus(Response::HTTP_BAD_REQUEST);
    }
}