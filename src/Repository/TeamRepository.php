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
        return $this->getEntityManager()
            ->createQuery(
                "SELECT t FROM App:Team t ORDER BY t.name ASC WHERE t.season=$season"
            )
            ->getResult();
    }
}
