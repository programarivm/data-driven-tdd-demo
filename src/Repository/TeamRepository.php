<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class TeamRepository.
 */
class TeamRepository extends EntityRepository
{
    /**
     * @param string $season
     *
     * @return mixed
     */
    public function findBySeason(string $season)
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
