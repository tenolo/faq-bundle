<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as SymfonyController;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;

/**
 * Class Controller
 *
 * @package Tenolo\Bundle\FAQBundle\Controller
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class Controller extends SymfonyController
{

    /**
     * @return \Tenolo\Bundle\FAQBundle\Repository\QuestionRepository
     */
    protected function getQuestionRepository()
    {
        return $this->getDoctrine()->getRepository(QuestionInterface::class);
    }

    /**
     * @return \Tenolo\Bundle\FAQBundle\Repository\CategoryRepository
     */
    protected function getCategoryRepository()
    {
        return $this->getDoctrine()->getRepository(CategoryInterface::class);
    }

}
