<?php

namespace Tenolo\Bundle\FAQBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Tenolo\Bundle\EntityBundle\Entity\BaseEntity;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\Enable;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\Name;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\SortOrder;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;

/**
 * Class Category
 *
 * @ORM\Entity(repositoryClass="Tenolo\Bundle\FAQBundle\Repository\CategoryRepository")
 *
 * @package Tenolo\Bundle\FAQBundle\Entity
 */
class Category extends BaseEntity implements CategoryInterface
{

    use Name;
    use Enable;
    use SortOrder;

    /**
     * @var ArrayCollection|PersistentCollection|QuestionInterface[]
     * @ORM\OneToMany(targetEntity="Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface", mappedBy="category")
     */
    protected $questions;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->questions = new ArrayCollection();
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @inheritDoc
     */
    public function hasQuestion(QuestionInterface $question)
    {
        return $this->getQuestions()->contains($question);
    }

    /**
     * @inheritDoc
     */
    public function addQuestion(QuestionInterface $question)
    {
        if (!$this->hasQuestion($question)) {
            $question->setCategory($this);
            $this->getQuestions()->add($question);
        }
    }

    /**
     * @inheritDoc
     */
    public function removeQuestion(QuestionInterface $question)
    {
        if ($this->hasQuestion($question)) {
            $this->getQuestions()->removeElement($question);
        }
    }

    /**
     * @inheritDoc
     */
    public function getSortedQuestions()
    {
        $criteria = Criteria::create();
        $criteria->orderBy(['rank' => 'ASC']);

        return $this->getQuestions()->matching($criteria);
    }
}
