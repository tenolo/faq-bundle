<?php

namespace Tenolo\Bundle\FAQBundle\Repository;

use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;

/**
 * Class QuestionRepository
 *
 * @package Tenolo\Bundle\FAQBundle\Repository
 */
class QuestionRepository extends BaseEntityRepository
{

    /**
     * @param int $max
     *
     * @return array|QuestionInterface[]
     */
    public function retrieveMostRecent($max)
    {
        $query = $this->getQueryBuilder()
            ->join('p.category', 'c')
            ->where('p.enable = :enable')
            ->andWhere('p.publishAt <= :publishAt')
            ->andWhere('(p.expiresAt IS NULL OR p.expiresAt >= :expiresAt)')
            ->orderBy('p.publishAt', 'DESC')
            ->setMaxResults($max)
            ->getQuery();

        $query->setParameter('enable', true);
        $query->setParameter('publishAt', new \DateTime());
        $query->setParameter('expiresAt', new \DateTime());

        return $query->getResult();
    }
}