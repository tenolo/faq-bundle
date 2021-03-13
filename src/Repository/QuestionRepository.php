<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Repository;

use DateTime;
use Doctrine\ORM\QueryBuilder;
use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;

/**
 * @method QuestionInterface|null find($id, ?int $lockMode = null, ?int $lockVersion = null)
 * @method QuestionInterface[] findAll()
 * @method QuestionInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionInterface[] findBy(array $criteria, array $orderBy = null, ?int $limit = null, ?int $offset = null)
 */
class QuestionRepository extends BaseEntityRepository
{
    public function applyEnabledQuery(QueryBuilder $qb): void
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
        $qb->setParameter('publishAt', new DateTime());
        $qb->setParameter('expiresAt', new DateTime());
    }
}
