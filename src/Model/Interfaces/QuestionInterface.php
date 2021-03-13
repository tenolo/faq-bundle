<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Model\Interfaces;

use DateTime;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\BaseEntityInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\EnableInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\NameInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\SortOrderInterface;
use Tenolo\Bundle\SlugifyBundle\Entity\Interfaces\SlugifyInterface;

/**
 * @company tenolo GbR
 */
interface QuestionInterface extends BaseEntityInterface, NameInterface, EnableInterface, SortOrderInterface, SlugifyInterface
{
    public function getCategory(): ?CategoryInterface;

    public function setCategory(?CategoryInterface $category = null): void;

    public function getContent(): ?string;

    public function setContent(?string $content): void;

    public function isTop(): bool;

    public function setTop(bool $top): void;

    public function getPublishAt(): DateTime;

    public function setPublishAt(DateTime $publishAt): void;

    public function getExpiresAt(): ?DateTime;

    public function setExpiresAt(?DateTime $expiresAt = null): void;

    public function isPublic(): bool;
}
