<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
    public function findBySeason($season)
    {
        $qb = $this->createQueryBuilder('t');

        return $qb
            ->where('t.season = :season')
            ->orderBy('t.name', 'ASC')
            ->setParameter('season', $season)
            ->getQuery()
            ->getResult()
        ;
    }
}
