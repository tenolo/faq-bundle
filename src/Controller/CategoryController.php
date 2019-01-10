<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Manager\CategoryManagerInterface;

/**
 * Class CategoryController
 *
 * @package Tenolo\Bundle\FAQBundle\Controller
 */
class CategoryController extends Controller
{
    /** @var CategoryManagerInterface */
    protected $categoryManager;

    /**
     * @param CategoryManagerInterface $categoryManager
     */
    public function __construct(CategoryManagerInterface $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    /**
     * @Route("/category/{category}-{slug}", name="tenolo_faq_category_show")
     *
     * @param int $category
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($category)
    {
        $category = $this->categoryManager->getRepository()->find($category);

        if (!$category) {
            throw $this->createNotFoundException();
        }

        return $this->render(
            $this->getParameter('tenolo_faq.templates.category.show'),
            [
                'categories' => $this->categoryManager->findActive(),
                'category'   => $category
            ]
        );
    }
}
