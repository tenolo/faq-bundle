<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 *
 * @package Tenolo\Bundle\FAQBundle\Controller
 */
class CategoryController extends Controller
{

    /**
     * @Route("/category/{category}-{slug}", name="tenolo_faq_category_show")
     *
     * @param int $category
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($category)
    {
        $category = $this->getCategoryRepository()->find($category);

        if (!$category) {
            throw $this->createNotFoundException();
        }

        return $this->render(
            $this->getParameter('tenolo_faq.templates.category.show'),
            [
                'category' => $category
            ]
        );
    }
}
