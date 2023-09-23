<?php

namespace App\Service;

use App\Entity\Citizen;
use App\Repository\CitizenRepository;
use App\Util\NISUtil;

class CitizenService
{
    private $citizenRepository;

    public function __construct(CitizenRepository $citizenRepository)
    {
        $this->citizenRepository = $citizenRepository;
    }

    public function findByNIS(string $nis): ?Citizen
    {
        return $this->citizenRepository->findByNIS($nis);
    }

    public function saveCitizen(string $name): Citizen
    {
        $nis = NISUtil::generateNIS();
        while ($this->findByNIS($nis)) {
            $nis = NISUtil::generateNIS();
        }
        return $this->citizenRepository->saveCitizen($name, $nis);
    }
}
