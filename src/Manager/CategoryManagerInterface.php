<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Manager;

use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Repository\CategoryRepository;

/**
 * @company tenolo GbR
 */
interface CategoryManagerInterface
{
    /**
     * @return CategoryInterface[]
     */
    public function findActive(): array;

    public function retrieveFirst(): ?CategoryInterface;

    public function getRepository(): CategoryRepository;
}
