<?php

namespace Tenolo\Bundle\FAQBundle\Repository;

use Doctrine\ORM\QueryBuilder;
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
        $qb = $this->getQueryBuilder();
        $expr = $qb->expr();

        $this->applyEnabledQuery($qb);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return CategoryInterface|null
     */
    public function retrieveFirst()
    {
        $qb = $this->getQueryBuilder();
        $expr = $qb->expr();

        $this->applyEnabledQuery($qb);
        $qb->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param QueryBuilder $qb
     */
    protected function applyEnabledQuery(QueryBuilder $qb)
    {
        $expr = $qb->expr();

        $qb->where($expr->eq('p.enable', ':enable'));
        $qb->orderBy('p.sortOrder', 'ASC');

        $qb->setParameter('enable', true);
    }
}