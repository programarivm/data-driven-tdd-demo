<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
    public function findBySeason($season)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT t FROM App:Team t ORDER BY t.name ASC WHERE t.season=$season"
            )
            ->getResult();
    }
}
