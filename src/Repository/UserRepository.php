<?php
# src/Repository/UserRepository.php

namespace Tuto\Repository;

use Doctrine\ORM\EntityRepository;
use Tuto\Entity\User;

class UserRepository extends EntityRepository
{
    public function find($id)
    {
        $queryBuilder = $this->_em->createQueryBuilder()
           ->select(['u', 'a', 'p']) // récupération des alias obligatoire pour que la jointure soit effective
           ->from(User::class, 'u')
           ->leftJoin('u.address', 'a')
           ->leftJoin('u.participations', 'p')
           ->where('u.id = :id')
           ->setParameter('id', $id);

        $query = $queryBuilder->getQuery();

        return $query->getOneOrNullResult();
    }

   // ...
}