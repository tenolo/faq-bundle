<?php

namespace Tenolo\Bundle\FAQBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\QueryBuilder;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;
use Tenolo\Bundle\FAQBundle\Repository\QuestionRepository;

/**
 * Class QuestionManager
 *
 * @package Tenolo\Bundle\FAQBundle\Manager
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class QuestionManager implements QuestionManagerInterface
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
     * @param int $max
     *
     * @return array|QuestionInterface[]
     */
    public function retrieveMostRecent($max = null)
    {
        $qb = $this->getRepository()->getQueryBuilder();

        $qb->join('p.category', 'c');
        $this->applyEnabledQuery($qb);

        if ($max) {
            $qb->setMaxResults($max);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param int $max
     *
     * @return array|QuestionInterface[]
     */
    public function findWithoutCategory($max = null)
    {
        $qb = $this->getRepository()->getQueryBuilder();
        $expr = $qb->expr();

        $this->applyEnabledQuery($qb);
        $qb->andWhere($expr->isNull('p.category'));

        if ($max) {
            $qb->setMaxResults($max);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param int $max
     *
     * @return array|QuestionInterface[]
     */
    public function findTop($max = null)
    {
        $qb = $this->getRepository()->getQueryBuilder();
        $expr = $qb->expr();

        $this->applyEnabledQuery($qb);
        $qb->andWhere($expr->eq('p.top', ':top'));

        $qb->setParameter('top', true);

        if ($max) {
            $qb->setMaxResults($max);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param QueryBuilder $qb
     */
    protected function applyEnabledQuery(QueryBuilder $qb)
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

    /**
     * @return ObjectRepository|QuestionRepository
     */
    public function getRepository()
    {
        return $this->registry->getRepository(QuestionInterface::class);
    }
}
