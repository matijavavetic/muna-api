<?php

namespace src\Applications\Http\Controllers;

use Illuminate\Http\JsonResponse;
use src\Applications\Factories\CheckRequestMapperFactory;
use src\Applications\Http\FormRequests\CheckRequest;
use Symfony\Component\HttpFoundation\Response;
use src\Business\Services\GuessingGameService;

class GuessingGameController extends Controller
{
    public function check(
        CheckRequest $request, 
        GuessingGameService $guessingGameService
    ): JsonResponse
    {
        $data = $request->validationData();

        $requestMapper = CheckRequestMapperFactory::make($data);

        $responseMapper = $guessingGameService->check($requestMapper);

        return new JsonResponse($responseMapper, Response::HTTP_OK);
    }
}