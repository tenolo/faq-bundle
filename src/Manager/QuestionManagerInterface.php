<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Manager;

use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;
use Tenolo\Bundle\FAQBundle\Repository\QuestionRepository;

/**
 * @company tenolo GbR
 */
interface QuestionManagerInterface
{
    /**
     * @return array<QuestionInterface>
     */
    public function retrieveMostRecent(?int $max = null): array;

    /**
     * @return array<QuestionInterface>
     */
    public function findWithoutCategory(?int $max = null): array;

    /**
     * @return array<QuestionInterface>
     */
    public function findByCategory(CategoryInterface $category, ?int $max = null): array;

    /**
     * @return array<QuestionInterface>
     */
    public function findTop(?int $max = null): array;

    public function getRepository(): QuestionRepository;
}
