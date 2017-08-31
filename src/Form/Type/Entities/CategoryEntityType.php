<?php

namespace Tenolo\Bundle\FAQBundle\Form\Type\Entities;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tenolo\Bundle\FAQBundle\Entity\Category;

/**
 * Class CategoryEntityType
 *
 * @package Tenolo\Bundle\FAQBundle\Form\Type\Entities
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class CategoryEntityType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Category::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getParent()
    {
        return EntityType::class;
    }

}
