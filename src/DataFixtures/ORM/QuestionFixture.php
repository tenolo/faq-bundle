<?php

namespace Tenolo\Bundle\FAQBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tenolo\Bundle\FAQBundle\Entity\Question;

/**
 * Class QuestionFixture
 *
 * @package Tenolo\Bundle\FAQBundle\Tests\Fixtures\ORM
 */
class QuestionFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            'category-subscription' => [
                'How can I get a subscription?',
                'When will my subscription renew?',
                'When will I receive the bill for my subscription?',
                'How do I cancel my subscription?',
                'This question exists in both categories'
            ],
            'category-website'      => [
                'I lost my password',
                'I cannot log in to the website',
                'I have a cool idea for the website',
                'This question exists in both categories'
            ]
        ];

        foreach ($data as $category => $questions) {
            foreach ($questions as $rank => $questionText) {
                $question = new Question();
                $question->setName($questionText);
                $question->setContent('The answer to the question "' . $questionText . '".');
                $question->setSortOrder($rank);
                $question->setCategory($this->getReference($category));

                $manager->persist($question);
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
