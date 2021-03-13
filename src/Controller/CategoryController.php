<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Manager\CategoryManagerInterface;
use Tenolo\Bundle\FAQBundle\Manager\QuestionManagerInterface;

class CategoryController extends AbstractController
{
    /** @var CategoryManagerInterface */
    protected $categoryManager;

    /** @var QuestionManagerInterface */
    private $questionManager;

    public function __construct(
        CategoryManagerInterface $categoryManager,
        QuestionManagerInterface $questionManager
    ) {
        $this->categoryManager = $categoryManager;
        $this->questionManager = $questionManager;
    }

    /**
     * @Route("/category/{category}-{slug}", name="tenolo_faq_category_show")
     */
    public function showAction(int $category): Response
    {
        $category = $this->categoryManager->getRepository()->find($category);

        if ($category === null) {
            throw $this->createNotFoundException();
        }

        $questions = $this->questionManager->findByCategory($category);

        return $this->render(
            $this->getParameter('tenolo_faq.templates.category.show'),
            [
                'categories' => $this->categoryManager->findActive(),
                'category'   => $category,
                'questions'  => $questions,
            ]
        );
    }
}
