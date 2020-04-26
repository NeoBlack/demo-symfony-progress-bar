<?php

/*
 * This file is part of the package neoblack/demo-symfony-progress-bar.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace App\Repository;

use App\Entity\ProgressDemo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgressDemo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgressDemo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgressDemo[]    findAll()
 * @method ProgressDemo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgressDemoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgressDemo::class);
    }

    public function remove(ProgressDemo $progressDemo): void
    {
        $em = $this->getEntityManager();
        $em->remove($progressDemo);
        $em->flush();
    }

    public function persist(ProgressDemo $progressDemo): void
    {
        $em = $this->getEntityManager();
        $em->persist($progressDemo);
        $em->flush();
    }
}
