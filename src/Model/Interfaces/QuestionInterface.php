<?php

namespace Tenolo\Bundle\FAQBundle\Model\Interfaces;

use Tenolo\Bundle\EntityBundle\Entity\Interfaces\BaseEntityInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\EnableInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\NameInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\SortOrderInterface;

/**
 * Interface QuestionInterface
 *
 * @package Tenolo\Bundle\FAQBundle\Model\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface QuestionInterface extends BaseEntityInterface, NameInterface, EnableInterface, SortOrderInterface
{

    /**
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * @param CategoryInterface $category
     */
    public function setCategory(CategoryInterface $category);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     */
    public function setContent($content);

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
