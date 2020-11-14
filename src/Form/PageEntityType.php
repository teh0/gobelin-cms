<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Page;
use App\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('content')
            ->add('thumbnail', FileType::class)
            ->add('categories', EntityType::class, [
                'class'         => Category::class,
                'query_builder' => $this->getQueryBuilderCategoryEntityType(),
                'choice_label'  => 'Categories'
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'query_builder' => $this->getQueryBuilderTagEntityType(),
                'choice_label' => 'Tags'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }

    private function getQueryBuilderCategoryEntityType(): \Closure
    {
        return function (EntityRepository $entityRepository) {
            return $entityRepository->createQueryBuilder('c')
                ->orderBy('c.name', 'ASC');
        };
    }

    private function getQueryBuilderTagEntityType(): \Closure
    {
        return function (EntityRepository $entityRepository) {
            return $entityRepository->createQueryBuilder('t')
                ->orderBy('t.name', 'ASC');
        };
    }
}
