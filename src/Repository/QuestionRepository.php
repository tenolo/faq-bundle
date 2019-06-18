<?php

namespace Tenolo\Bundle\FAQBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;

/**
 * Class QuestionRepository
 *
 * @package Tenolo\Bundle\FAQBundle\Repository
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class QuestionRepository extends BaseEntityRepository
{

    /**
     * @param QueryBuilder $qb
     */
    public function applyEnabledQuery(QueryBuilder $qb)
    {
        $expr = $qb->expr();

        $qb->where($expr->eq('p.enable', ':enable'));
        $qb->andWhere($expr->lte('p.publishAt', ':publishAt'));
        $qb->andWhere($expr->orX(
            $expr->isNull('p.expiresAt'),
            $expr->gte('p.expiresAt', ':expiresAt')
        ));
        $qb->orderBy('p.sortOrder', 'ASC');

        $qb->setParameter('enable', true);
        $qb->setParameter('publishAt', new \DateTime());
        $qb->setParameter('expiresAt', new \DateTime());
    }
}