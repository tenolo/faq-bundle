<?php

namespace Tenolo\Bundle\FAQBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tenolo\Bundle\FAQBundle\Entity\Category;

/**
 * Class CategoryFixture
 *
 * @package Tenolo\Bundle\FAQBundle\Tests\Fixtures\ORM
 */
class CategoryFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Subscription');
        $category->setSortOrder(0);
        $manager->persist($category);

        $this->addReference('category-subscription', $category);

        $category = new Category();
        $category->setName('Website');
        $category->setSortOrder(1);
        $manager->persist($category);

        $this->addReference('category-website', $category);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
