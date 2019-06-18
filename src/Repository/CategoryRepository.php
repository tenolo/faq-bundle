<?php

namespace Tenolo\Bundle\FAQBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;

/**
 * Class CategoryRepository
 *
 * @package Tenolo\Bundle\FAQBundle\Repository
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class CategoryRepository extends BaseEntityRepository
{

    /**
     * @param QueryBuilder $qb
     */
    public function applyEnabledQuery(QueryBuilder $qb)
    {
        $expr = $qb->expr();

        $qb->where($expr->eq('p.enable', ':enable'));
        $qb->orderBy('p.sortOrder', 'ASC');

        $qb->setParameter('enable', true);
    }
}