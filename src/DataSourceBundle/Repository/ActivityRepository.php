<?php

namespace DataSourceBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ActivityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActivityRepository extends EntityRepository {

    public function getActivitiesOfProfile ($profileId = 0) {
        // $qb instanceof QueryBuilder
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select("ac")
            ->join('ac.profile', 'p');
        if($profileId > 0) {
           $qb->where('r.id = ' . $profileId);
        }

        return $qb->getQuery()->getResult();
    }
}
