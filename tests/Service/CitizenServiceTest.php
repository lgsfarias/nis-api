<?php

namespace App\Tests\Service;

use App\Entity\Citizen;
use App\Repository\CitizenRepository;
use App\Service\CitizenService;
use App\Util\NISUtil;
use PHPUnit\Framework\TestCase;

class CitizenServiceTest extends TestCase
{
    private $citizenService;
    private $citizenRepositoryMock;

    protected function setUp(): void
    {
        $this->citizenRepositoryMock = $this->createMock(CitizenRepository::class);
        $this->citizenService = new CitizenService($this->citizenRepositoryMock);
    }

    public function testFindByNISReturnsNullWhenNotFound()
    {
        $nis = '12345678901';

        $this->citizenRepositoryMock->expects($this->once())
            ->method('findByNIS')
            ->with($nis)
            ->willReturn(null);

        $this->assertNull($this->citizenService->findByNIS($nis));
    }

    public function testFindByNisReturnsCitizenWhenFound()
    {
        $nis = '12345678901';

        $this->citizenRepositoryMock->expects($this->once())
            ->method('findByNIS')
            ->with($nis)
            ->willReturn(new Citizen());

        $this->assertInstanceOf(Citizen::class, $this->citizenService->findByNIS($nis));
    }

    public function testSaveCitizenWithUniqueNis()
    {
        {
            $name = 'John Doe';

            $this->citizenRepositoryMock->method('findByNIS')
            ->will($this->onConsecutiveCalls(new Citizen(), null));

            $this->citizenRepositoryMock->expects($this->once())
                ->method('saveCitizen')
                ->willReturn(new Citizen());

            $this->assertInstanceOf(Citizen::class, $this->citizenService->saveCitizen($name));
        }
    }
}