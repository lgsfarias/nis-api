<?php

namespace App\Controller;

use App\Service\CitizenService;
use App\Util\NISUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class CitizenController extends AbstractController
{

    private $citizenService;

    public function __construct(CitizenService $citizenService)
    {
        $this->citizenService = $citizenService;
    }

    /**
     * @Route("/citizen", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $body = json_decode($request->getContent(), true);
        if (!isset($body['name'])) {
            return new JsonResponse([
                'message' => 'Name is required',
            ], Response::HTTP_BAD_REQUEST);
        }

        $name = $body['name'];

        $citizen = $this->citizenService->saveCitizen($name);

        return new JsonResponse([
            'nis' => $citizen->getNis(),
            'name' => $citizen->getName(),
        ]);
    }

    /**
     * @Route("/citizen/{nis}", methods={"GET"})
     */
    public function getByNIS(string $nis): Response
    {
        if (!NISUtil::isValidNis($nis)) {
            return new JsonResponse([
                'message' => 'Invalid NIS',
            ], Response::HTTP_BAD_REQUEST);
        }

        $citizen = $this->citizenService->findByNIS($nis);

        if (!$citizen) {
            return new JsonResponse([
                'message' => 'Citizen not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'nis' => $citizen->getNis(),
            'name' => $citizen->getName(),
        ]);
    }

    /**
     * @Route("/validate/{nis}", methods={"GET"})
     */
    public function validateNIS(string $nis): Response
    {
        $isValid = NISUtil::isValidNis($nis);

        return new JsonResponse([
            'nis' => $nis,
            'isValid' => $isValid,
        ]);
    }
}
