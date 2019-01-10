<?php

namespace Tenolo\Bundle\FAQBundle\Manager;

use Doctrine\Common\Persistence\ObjectRepository;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;
use Tenolo\Bundle\FAQBundle\Repository\QuestionRepository;

/**
 * Interface QuestionManagerInterface
 *
 * @package Tenolo\Bundle\FAQBundle\Manager
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface QuestionManagerInterface
{

    /**
     * @param int $max
     *
     * @return array|QuestionInterface[]
     */
    public function retrieveMostRecent($max = null);

    /**
     * @param int $max
     *
     * @return array|QuestionInterface[]
     */
    public function findWithoutCategory($max = null);

    /**
     * @param int $max
     *
     * @return array|QuestionInterface[]
     */
    public function findTop($max = null);

    /**
     * @return ObjectRepository|QuestionRepository
     */
    public function getRepository();
}
