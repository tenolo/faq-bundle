<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Manager\CategoryManagerInterface;
use Tenolo\Bundle\FAQBundle\Manager\QuestionManagerInterface;

/**
 * Class FaqController
 *
 * @package Tenolo\Bundle\FAQBundle\Controller
 */
class FaqController extends Controller
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
     * @Route("", name="tenolo_faq_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render(
            $this->getParameter('tenolo_faq.templates.faq.index'),
            [
                'categories' => $this->categoryManager->findActive(),
                'questions'  => $this->questionManager->findTop(),
            ]
        );
    }

    /**
     * @Route("/{category}-{slug}", name="tenolo_faq_show")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($category)
    {
        $categories = $this->categoryManager->findActive();
        $category = $this->categoryManager->getRepository()->find($category);

        if (!$category || !$categories) {
            throw $this->createNotFoundException('You need at least 1 active faq category in the database');
        }

        return $this->render(
            $this->getParameter('tenolo_faq.templates.faq.index'),
            [
                'category'   => $category,
            ]
        );
    }
}
