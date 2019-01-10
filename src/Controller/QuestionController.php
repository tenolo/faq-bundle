<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Manager\CategoryManagerInterface;
use Tenolo\Bundle\FAQBundle\Manager\QuestionManagerInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;

/**
 * Class QuestionController
 *
 * @package Tenolo\Bundle\FAQBundle\Controller
 */
class QuestionController extends Controller
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
     * @Route("/question/{question}-{slug}", name="tenolo_faq_question_show")
     *
     * @param int $question
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($question)
    {
        /** @var QuestionInterface $question */
        $question = $this->questionManager->getRepository()->find($question);

        if (!$question || !$question->isPublic()) {
            throw $this->createNotFoundException('question not found');
        }

        return $this->render(
            $this->getParameter('tenolo_faq.templates.question.show'),
            [
                'categories' => $this->categoryManager->findActive(),
                'question'   => $question
            ]
        );
    }

    /**
     * @Route("/questions/most-recent", name="tenolo_faq_questions_most_recent")
     *
     * @param int $max
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listMostRecentAction($max = 3)
    {
        $questions = $this->questionManager->retrieveMostRecent($max);

        return $this->render(
            $this->getParameter('tenolo_faq.templates.question.most_recent'),
            [
                'categories' => $this->categoryManager->findActive(),
                'questions'  => $questions,
                'max'        => $max
            ]
        );
    }
}
