<?php

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Manager\QuestionManagerInterface;
use Tenolo\Bundle\FAQBundle\Model\Interfaces\QuestionInterface;

/**
 * Class QuestionController
 *
 * @package Tenolo\Bundle\FAQBundle\Controller
 */
class QuestionController extends Controller
{

    /** @var QuestionManagerInterface */
    protected $questionManager;

    /**
     * @param QuestionManagerInterface $questionManager
     */
    public function __construct(QuestionManagerInterface $questionManager)
    {
        $this->questionManager = $questionManager;
    }

    /**
     * @Route("/question/{question}-{slug}", name="tenolo_faq_question_show")
     *
     * @param int $question
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
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
                'question' => $question,
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
                'questions' => $questions,
                'max'       => $max,
            ]
        );
    }
}
