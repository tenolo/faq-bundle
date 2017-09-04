<?php

namespace Tenolo\Bundle\FAQBundle\Model\Interfaces;

use Tenolo\Bundle\EntityBundle\Entity\Interfaces\BaseEntityInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\EnableInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\NameInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\SortOrderInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;

/**
 * Interface QuestionInterface
 *
 * @package Tenolo\Bundle\FAQBundle\Model\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface QuestionInterface extends BaseEntityInterface, NameInterface, EnableInterface, SortOrderInterface, SlugifyInterface
{

    /**
     * @return CategoryInterface|null
     */
    public function getCategory();

    /**
     * @param CategoryInterface|null $category
     */
    public function setCategory(CategoryInterface $category = null);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     */
    public function setContent($content);

    /**
     * @return bool
     */
    public function isTop();

    /**
     * @param bool $top
     */
    public function setTop($top);

    /**
     * @return \DateTime
     */
    public function getPublishAt();

    /**
     * @param \DateTime $publishAt
     */
    public function setPublishAt(\DateTime $publishAt);

    /**
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * @param \DateTime $expiresAt
     */
    public function setExpiresAt(\DateTime $expiresAt = null);

    /**
     * @return boolean
     */
    public function isPublic();
}
