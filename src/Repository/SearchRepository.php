<?php

namespace Tenolo\Bundle\FAQBundle\Repository;

use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;

/**
 * Class SearchRepository
 *
 * @package Tenolo\Bundle\FAQBundle\Repository
 */
class SearchRepository extends BaseEntityRepository
{
    /**
     * @param int $max
     *
     * @return DoctrineCollection|null
     */
    public function retrieveMostPopular($max)
    {
        $query = $this->createQueryBuilder('s')
            ->orderBy('s.searchCount', 'DESC')
            ->setMaxResults($max)
            ->getQuery();

        return $query->getResult();
    }
}