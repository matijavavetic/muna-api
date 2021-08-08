<?php

namespace src\Applications\Http\Controllers;

use Illuminate\Http\JsonResponse;
use src\Applications\Factories\CheckRequestMapperFactory;
use src\Applications\Http\FormRequests\CheckRequest;
use Symfony\Component\HttpFoundation\Response;
use src\Business\Services\PatternCheckerService;

class PatternCheckerController extends Controller
{
    public function check(
        CheckRequest $request, 
        PatternCheckerService $patternCheckerService
    ): JsonResponse
    {
        $data = $request->validationData();

        $requestMapper = CheckRequestMapperFactory::make($data);

        $responseMapper = $patternCheckerService->check($requestMapper);

        return new JsonResponse($responseMapper, Response::HTTP_OK);
    }
}