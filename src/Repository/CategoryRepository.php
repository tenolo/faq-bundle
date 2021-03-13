<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;

/**
 * @method CategoryInterface|null find($id, ?int $lockMode = null, ?int $lockVersion = null)
 * @method CategoryInterface[] findAll()
 * @method CategoryInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryInterface[] findBy(array $criteria, array $orderBy = null, ?int $limit = null, ?int $offset = null)
 */
class CategoryRepository extends BaseEntityRepository
{
    public function applyEnabledQuery(QueryBuilder $qb): void
    {
        $expr = $qb->expr();

        $qb->where($expr->eq('p.enable', ':enable'));
        $qb->orderBy('p.sortOrder', 'ASC');

        $qb->setParameter('enable', true);
    }
}
