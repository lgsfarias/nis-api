<?php

namespace App\Repository;

use App\Entity\Citizen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Citizen>
 *
 * @method Citizen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Citizen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Citizen[]    findAll()
 * @method Citizen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitizenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Citizen::class);
    }

    /**
     * Find a Citizen by its NIS
     *
     * @param string $nis
     * @return Citizen|null
     */
    public function findByNIS(string $nis): ?Citizen
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nis = :nis')
            ->setParameter('nis', $nis)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Save a new Citizen and assign a NIS to them
     *
     * @param string $name
     * @return Citizen
     * @throws \Exception
     */
    public function saveCitizen(string $name, string $nis): Citizen
    {
        $citizen = new Citizen();
        $citizen->setName($name);
        $citizen->setNis($nis);

        $em = $this->getEntityManager();
        $em->persist($citizen);
        $em->flush();

        return $citizen;
    }
}
