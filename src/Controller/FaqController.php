<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\CategoryInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;

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

        // Throw 404 if there is no category in the database
        if (!$categories) {
            throw $this->createNotFoundException('You need at least 1 active faq category in the database');
        }

        return $this->render(
            'GenjFaqBundle:Faq:index.html.twig',
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

        // Throw 404 if there is no category in the database
        if (!$category || !$categories) {
            throw $this->createNotFoundException('You need at least 1 active faq category in the database');
        }

        if ($category) {
            $questions = $category->getSortedQuestions();
        }

        return $this->render(
            'GenjFaqBundle:Faq:index.html.twig',
            [
                'categories'       => $categories,
                'selectedCategory' => $category,
            ]
        );
    }

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
