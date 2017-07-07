<?php

namespace Tenolo\Bundle\FAQBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tenolo\Bundle\EntityBundle\Entity\BaseEntity;

/**
 * Class Search
 *
 * @ORM\MappedSuperclass
 * @ORM\Entity(repositoryClass="Tenolo\Bundle\FAQBundle\Repository\SearchRepository")
 *
 * @package Tenolo\Bundle\FAQBundle\Entity
 */
class Search extends BaseEntity
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $headline;

    /**
     * @ORM\Column(type="integer")
     */
    protected $searchCount;

    /**
     * Set headline
     *
     * @param string $headline
     *
     * @return Search
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * Get headline
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Get searchCount
     *
     * @return int
     */
    public function getSearchCount()
    {
        return $this->searchCount;
    }

    /**
     * Set searchCount
     *
     * @param int $searchCount
     *
     * @return Search
     */
    public function setSearchCount($searchCount)
    {
        $this->searchCount = $searchCount;
    }

    /**
     * Returns a string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getHeadline();
    }

    /**
     * Returns the route name for url generation
     *
     * @return string
     */
    public function getRouteName()
    {
        return 'genj_faq_search_show';
    }

    /**
     * Returns the route parameters for url generation
     *
     * @return array
     */
    public function getRouteParameters()
    {
        return [
            'slug' => $this->getSlug()
        ];
    }
}
