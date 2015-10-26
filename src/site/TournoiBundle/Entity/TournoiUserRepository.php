<?php

namespace site\TournoiBundle\Entity;

/**
 * TournoiUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TournoiUserRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByTournoiWithEquipes($tournoi){
        $qb = $this
            ->createQueryBuilder('t')
            ->join('t.equipe', 'equipe')
            ->addSelect('equipe')
            ->where('t.tournoi = :tournoi')
            ->setParameter('tournoi',$tournoi);
        ;

        return $qb
            ->getQuery()
            ->getResult()
            ;
    }
}
