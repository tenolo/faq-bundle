<?php

namespace Tenolo\Bundle\FAQBundle\Manager;

use Doctrine\Common\Persistence\ObjectRepository;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Repository\CategoryRepository;

/**
 * Interface CategoryManagerInterface
 *
 * @package Tenolo\Bundle\FAQBundle\Manager
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface CategoryManagerInterface
{

    /**
     * @return CategoryInterface[]
     */
    public function findActive();

    /**
     * @return CategoryInterface|null
     */
    public function retrieveFirst();

    /**
     * @return ObjectRepository|CategoryRepository
     */
    public function getRepository();
}
