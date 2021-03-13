<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Repository\CategoryRepository;

use function assert;

/**
 * @company tenolo GbR
 */
class CategoryManager implements CategoryManagerInterface
{
    /** @var ManagerRegistry */
    protected $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return CategoryInterface[]
     */
    public function findActive(): array
    {
        $qb = $this->getRepository()->getQueryBuilder();

        $this->applyEnabledQuery($qb);

        return $qb->getQuery()->getResult();
    }

    public function retrieveFirst(): ?CategoryInterface
    {
        $qb = $this->getRepository()->getQueryBuilder();

        $this->applyEnabledQuery($qb);
        $qb->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    protected function applyEnabledQuery(QueryBuilder $qb): void
    {
        $this->getRepository()->applyEnabledQuery($qb);
    }

    public function getRepository(): CategoryRepository
    {
        $repo = $this->registry->getRepository(CategoryInterface::class);
        assert($repo instanceof CategoryRepository);

        return $repo;
    }
}
