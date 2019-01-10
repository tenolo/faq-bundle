<?php

namespace Tenolo\Bundle\FAQBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\QueryBuilder;
use RabeConcept\Shop\Component\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Repository\CategoryRepository;

/**
 * Class CategoryManager
 *
 * @package Tenolo\Bundle\FAQBundle\Manager
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class CategoryManager implements CategoryManagerInterface
{

    /** @var ManagerRegistry */
    protected $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return mixed|CategoryInterface[]
     */
    public function findActive()
    {
        $qb = $this->getRepository()->getQueryBuilder();

        $this->applyEnabledQuery($qb);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return CategoryInterface|null
     */
    public function retrieveFirst()
    {
        $qb = $this->getRepository()->getQueryBuilder();

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

    /**
     * @return ObjectRepository|CategoryRepository
     */
    public function getRepository()
    {
        return $this->registry->getRepository(CategoryInterface::class);
    }
}
