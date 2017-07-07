<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;

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
            'TenoloFAQBundle:Category:show.html.twig',
            [
                'category' => $category
            ]
        );
    }

    /**
     * @return \Tenolo\Bundle\FAQBundle\Repository\CategoryRepository
     */
    protected function getCategoryRepository()
    {
        return $this->getDoctrine()->getRepository(CategoryInterface::class);
    }
}
