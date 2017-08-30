<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FaqController
 *
 * @package Tenolo\Bundle\FAQBundle\Controller
 */
class FaqController extends Controller
{

    /**
     * @Route("/", name="tenolo_faq_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $categories = $this->getCategoryRepository()->findActive();

        return $this->render(
            $this->getParameter('tenolo_faq.templates.faq.index'),
            [
                'categories' => $categories,
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
        $categories = $this->getCategoryRepository()->findActive();
        $category = $this->getCategoryRepository()->find($category);

        if (!$category || !$categories) {
            throw $this->createNotFoundException('You need at least 1 active faq category in the database');
        }

        return $this->render(
            $this->getParameter('tenolo_faq.templates.faq.index'),
            [
                'categories' => $categories,
                'category'   => $category,
            ]
        );
    }
}
