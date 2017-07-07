<?php

namespace Tenolo\Bundle\FAQBundle\Model\Interfaces;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\BaseEntityInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\EnableInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\NameInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\SortOrderInterface;

/**
 * Interface CategoryInterface
 *
 * @package Tenolo\Bundle\FAQBundle\Model\Interfaces
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface CategoryInterface extends BaseEntityInterface, NameInterface, EnableInterface, SortOrderInterface
{

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     */
    public function setContent($content);

    /**
     * @return ArrayCollection|PersistentCollection|QuestionInterface[]
     */
    public function getQuestions();

    /**
     * @param QuestionInterface $question
     *
     * @return bool
     */
    public function hasQuestion(QuestionInterface $question);

    /**
     * @param QuestionInterface $question
     */
    public function addQuestion(QuestionInterface $question);

    /**
     * @param QuestionInterface $question
     */
    public function removeQuestion(QuestionInterface $question);

    /**
     * @return ArrayCollection|QuestionInterface[]
     */
    public function getSortedQuestions();
}
