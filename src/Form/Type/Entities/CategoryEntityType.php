<?php

declare(strict_types=1);

namespace Tenolo\Bundle\FAQBundle\Form\Type\Entities;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tenolo\Bundle\FAQBundle\Entity\Category;

/**
 * @company tenolo GbR
 */
class CategoryEntityType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Category::class,
        ]);
    }

    public function getParent(): string
    {
        return EntityType::class;
    }
}
