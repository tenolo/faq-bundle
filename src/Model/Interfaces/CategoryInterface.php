<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Model\Interfaces;

use Doctrine\Common\Collections\Collection;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\BaseEntityInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\EnableInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\NameInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\SortOrderInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;

/**
 * @company tenolo GbR
 */
interface CategoryInterface extends BaseEntityInterface, NameInterface, EnableInterface, SortOrderInterface, SlugifyInterface
{
    public function getContent(): ?string;

    public function setContent(?string $content): void;

    /**
     * @return Collection<int, QuestionInterface>
     */
    public function getQuestions(): Collection;

    public function hasQuestion(QuestionInterface $question): bool;

    public function addQuestion(QuestionInterface $question): void;

    public function removeQuestion(QuestionInterface $question): void;
}
