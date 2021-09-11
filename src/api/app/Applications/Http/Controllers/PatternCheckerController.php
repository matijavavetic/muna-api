<?php

namespace src\Applications\Http\Controllers;

use Illuminate\Http\JsonResponse;
use src\Applications\Factories\CheckRequestMapperFactory;
use src\Applications\Factories\StatRequestMapperFactory;
use src\Applications\Http\FormRequests\CheckRequest;
use src\Applications\Http\FormRequests\StatRequest;
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

        $response['state'] = $responseMapper;

        return new JsonResponse([$response], Response::HTTP_OK);
    }

    public function stat(
        StatRequest $request, 
        PatternCheckerService $patternCheckerService
    ): JsonResponse
    {
        $data = $request->validationData();

        $requestMapper = StatRequestMapperFactory::make($data);

        $responseMapper = $patternCheckerService->stat($requestMapper);

        return new JsonResponse($responseMapper, Response::HTTP_OK);
    }
}