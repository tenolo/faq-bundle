<?php

namespace Tenolo\Bundle\FAQBundle\Repository;

use Tenolo\Bundle\EntityBundle\Repository\BaseEntityRepository;

/**
 * Class QuestionRepository
 *
 * @package Tenolo\Bundle\FAQBundle\Repository
 */
class QuestionRepository extends BaseEntityRepository
{
    /**
     * @param string $categorySlug
     *
     * @return Question|null
     */
    public function retrieveFirstByCategorySlug($categorySlug)
    {
        $query = $this->createQueryBuilder('q')
            ->join('q.category', 'c')
            ->where('c.slug = :categorySlug')
            ->andWhere('q.isActive = :isActive')
            ->andWhere('q.publishAt <= :publishAt')
            ->andWhere('(q.expiresAt IS NULL OR q.expiresAt >= :expiresAt)')
            ->orderBy('q.rank', 'ASC')
            ->setMaxResults(1)
            ->getQuery();

        $query->setParameter('categorySlug', $categorySlug);
        $query->setParameter('isActive', true);
        $query->setParameter('publishAt', date('Y-m-d H:i:s'));
        $query->setParameter('expiresAt', date('Y-m-d H:i:s'));

        return $query->getOneOrNullResult();
    }

    /**
     * @param int $max
     *
     * @return DoctrineCollection|null
     */
    public function retrieveMostRecent($max)
    {
        $query = $this->createQueryBuilder('q')
            ->join('q.category', 'c')
            ->where('q.isActive = :isActive')
            ->andWhere('q.publishAt <= :publishAt')
            ->andWhere('(q.expiresAt IS NULL OR q.expiresAt >= :expiresAt)')
            ->orderBy('q.publishAt', 'DESC')
            ->setMaxResults($max)
            ->getQuery();

        $query->setParameter('isActive', true);
        $query->setParameter('publishAt', date('Y-m-d H:i:s'));
        $query->setParameter('expiresAt', date('Y-m-d H:i:s'));

        return $query->getResult();
    }

    /**
     * @param string $searchQuery
     * @param int    $max
     *
     * @return DoctrineCollection|null
     */
    public function retrieveByQuery($searchQuery, $max)
    {
        $query = $this->createQueryBuilder('q')
            ->join('q.category', 'c')
            ->where('q.headline like :searchQuery or q.body like :searchQuery')
            ->andWhere('q.isActive = :isActive')
            ->andWhere('q.publishAt <= :publishAt')
            ->andWhere('(q.expiresAt IS NULL OR q.expiresAt >= :expiresAt)')
            ->orderBy('q.publishAt', 'DESC')
            ->setMaxResults($max)
            ->getQuery();

        $query->setParameter('searchQuery', '%' . $searchQuery . '%');
        $query->setParameter('isActive', true);
        $query->setParameter('publishAt', date('Y-m-d H:i:s'));
        $query->setParameter('expiresAt', date('Y-m-d H:i:s'));

        return $query->getResult();
    }
}