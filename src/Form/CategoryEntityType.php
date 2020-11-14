<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->buildName($builder)
            ->buildIcon($builder)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }

    private function buildName(FormBuilderInterface $builder): CategoryEntityType
    {
        $builder->add('name', TextType::class);
        return $this;
    }

    private function buildIcon(FormBuilderInterface $builder): CategoryEntityType
    {
        $builder->add('icon', FileType::class, [
            'data_class' => null
        ]);
        return $this;
    }
}
