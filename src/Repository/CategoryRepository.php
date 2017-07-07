<?php

namespace Tenolo\Bundle\FAQBundle\Repository;

use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;

/**
 * Class CategoryRepository
 *
 * @package Tenolo\Bundle\FAQBundle\Repository
 */
class CategoryRepository extends BaseEntityRepository
{

    /**
     * @return mixed|CategoryInterface[]
     */
    public function findActive()
    {
        $query = $this->getQueryBuilder()
            ->where('p.enable = :enable')
            ->orderBy('p.sortOrder', 'ASC')
            ->getQuery();

        $query->setParameter('enable', true);

        return $query->execute();
    }

    /**
     * @return CategoryInterface|null
     */
    public function retrieveFirst()
    {
        $query = $this->getQueryBuilder()
            ->where('p.enable = :enable')
            ->orderBy('p.sortOrder', 'ASC')
            ->setMaxResults(1)
            ->getQuery();

        $query->setParameter('enable', true);

        return $query->getOneOrNullResult();
    }
}