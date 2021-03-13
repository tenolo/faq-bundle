<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Tenolo\Bundle\EntityBundle\Entity\BaseEntity;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\Enable;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\Name;
use Tenolo\Bundle\EntityBundle\Entity\Scheme\SortOrder;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Scheme\DefaultRawMaterial;
use Tenolo\Bundle\SlugifyBundle\Entity\Scheme\Slugify;

/**
 * @ORM\Entity(repositoryClass="Tenolo\Bundle\FAQBundle\Repository\CategoryRepository")
 */
class Category extends BaseEntity implements CategoryInterface
{
    use Name;
    use Enable;
    use SortOrder;
    use Slugify;
    use DefaultRawMaterial;

    /**
     * @ORM\OneToMany(targetEntity="Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface", mappedBy="category")
     *
     * @var Collection<int, QuestionInterface>
     */
    protected $questions;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string|null
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return Collection<int, QuestionInterface>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function hasQuestion(QuestionInterface $question): bool
    {
        return $this->getQuestions()->contains($question);
    }

    public function addQuestion(QuestionInterface $question): void
    {
        if ($this->hasQuestion($question)) {
            return;
        }

        $question->setCategory($this);
        $this->getQuestions()->add($question);
    }

    public function removeQuestion(QuestionInterface $question): void
    {
        if (! $this->hasQuestion($question)) {
            return;
        }

        $this->getQuestions()->removeElement($question);
    }
}
