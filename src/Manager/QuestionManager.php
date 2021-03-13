<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\QueryBuilder;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;
use Tenolo\Bundle\FAQBundle\Repository\QuestionRepository;

use function assert;

/**
 * @company tenolo GbR
 */
class QuestionManager implements QuestionManagerInterface
{
    /** @var ManagerRegistry */
    protected $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return array<QuestionInterface>
     */
    public function retrieveMostRecent(?int $max = null): array
    {
        $qb = $this->getRepository()->getQueryBuilder();

        $qb->join('p.category', 'c');
        $this->applyEnabledQuery($qb);

        if ($max > 0) {
            $qb->setMaxResults($max);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array<QuestionInterface>
     */
    public function findWithoutCategory(?int $max = null): array
    {
        $qb   = $this->getRepository()->getQueryBuilder();
        $expr = $qb->expr();

        $this->applyEnabledQuery($qb);
        $qb->andWhere($expr->isNull('p.category'));

        if ($max > 0) {
            $qb->setMaxResults($max);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array<QuestionInterface>
     */
    public function findByCategory(CategoryInterface $category, ?int $max = null): array
    {
        $qb = $this->getRepository()->getQueryBuilder();

        $this->applyEnabledQuery($qb);
        $qb->andWhere('p.category = :category');
        $qb->setParameter('category', $category->getId(), Types::INTEGER);
        $qb->orderBy('p.sortOrder', 'ASC');

        if ($max > 0) {
            $qb->setMaxResults($max);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array<QuestionInterface>
     */
    public function findTop(?int $max = null): array
    {
        $qb   = $this->getRepository()->getQueryBuilder();
        $expr = $qb->expr();

        $this->applyEnabledQuery($qb);
        $qb->andWhere($expr->eq('p.top', ':top'));

        $qb->setParameter('top', true);

        if ($max > 0) {
            $qb->setMaxResults($max);
        }

        return $qb->getQuery()->getResult();
    }

    protected function applyEnabledQuery(QueryBuilder $qb): void
    {
        $this->getRepository()->applyEnabledQuery($qb);
    }

    public function getRepository(): QuestionRepository
    {
        $repo = $this->registry->getRepository(QuestionInterface::class);
        assert($repo instanceof QuestionRepository);

        return $repo;
    }
}
