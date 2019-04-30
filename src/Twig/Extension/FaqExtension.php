<?php

namespace Tenolo\Bundle\FAQBundle\Twig\Extension;

use Tenolo\Bundle\FAQBundle\Manager\CategoryManagerInterface;
use Tenolo\Bundle\FAQBundle\Manager\QuestionManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;

/**
 * Class FaqExtension
 *
 * @package Tenolo\Bundle\FAQBundle\Twig\Extension
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class FaqExtension extends AbstractExtension
{

    /** @var CategoryManagerInterface */
    protected $categoryManager;

    /** @var QuestionManagerInterface */
    protected $questionManager;

    /**
     * @param CategoryManagerInterface $categoryManager
     * @param QuestionManagerInterface $questionManager
     */
    public function __construct(CategoryManagerInterface $categoryManager, QuestionManagerInterface $questionManager)
    {
        $this->categoryManager = $categoryManager;
        $this->questionManager = $questionManager;
    }

    /**
     * @inheritDoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('faq_get_active_categories', [$this, 'getActiveCategories']),
            new TwigFunction('faq_get_top_questions', [$this, 'getTopQuestions']),
        ];
    }

    /**
     * @return array|CategoryInterface[]
     */
    public function getActiveCategories()
    {
        return $this->categoryManager->findActive();
    }

    /**
     * @return array|QuestionInterface[]
     */
    public function getTopQuestions()
    {
        return $this->questionManager->findTop();
    }

}
