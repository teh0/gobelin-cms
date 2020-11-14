<?php

namespace App\Form;

use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->buildName($builder)
            ->buildColor($builder)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tag::class,
        ]);
    }

    private function buildName(FormBuilderInterface $builder): TagEntityType
    {
        $builder->add('name', TextType::class);
        return $this;
    }

    private function buildColor(FormBuilderInterface $builder): TagEntityType
    {
        $builder->add('color', ColorType::class);
        return $this;
    }
}
