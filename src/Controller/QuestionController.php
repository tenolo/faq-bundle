<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Tenolo\Bundle\FAQBundle\Manager\QuestionManagerInterface;

class QuestionController extends AbstractController
{
    /** @var QuestionManagerInterface */
    protected $questionManager;

    public function __construct(QuestionManagerInterface $questionManager)
    {
        $this->questionManager = $questionManager;
    }

    /**
     * @throws NotFoundHttpException
     *
     * @Route("/question/{question}-{slug}", name="tenolo_faq_question_show")
     */
    public function showAction(int $question): Response
    {
        $question = $this->questionManager->getRepository()->find($question);

        if ($question === null || ! $question->isPublic()) {
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
     */
    public function listMostRecentAction(int $max = 3): Response
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
