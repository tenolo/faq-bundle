<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Manager\CategoryManagerInterface;
use Tenolo\Bundle\FAQBundle\Manager\QuestionManagerInterface;

use function count;

class FaqController extends AbstractController
{
    /** @var CategoryManagerInterface */
    protected $categoryManager;

    /** @var QuestionManagerInterface */
    protected $questionManager;

    public function __construct(CategoryManagerInterface $categoryManager, QuestionManagerInterface $questionManager)
    {
        $this->categoryManager = $categoryManager;
        $this->questionManager = $questionManager;
    }

    /**
     * @Route("", name="tenolo_faq_index")
     */
    public function indexAction(): Response
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
     */
    public function showAction(int $category): Response
    {
        $categories = $this->categoryManager->findActive();
        $category   = $this->categoryManager->getRepository()->find($category);

        if ($category === null || count($categories) === 0) {
            throw $this->createNotFoundException('You need at least 1 active faq category in the database');
        }

        $questions = $this->questionManager->findByCategory($category);

        return $this->render(
            $this->getParameter('tenolo_faq.templates.faq.index'),
            [
                'category'   => $category,
                'questions'  => $questions,
            ]
        );
    }
}
