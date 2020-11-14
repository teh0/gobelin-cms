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
        $this
            ->buildTitle($builder)
            ->buildDescription($builder)
            ->buildContent($builder)
            ->buildThumbnail($builder)
            ->buildCategories($builder)
            ->buildCategories($builder)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }

    private function buildTitle(FormBuilderInterface $builder): PageEntityType
    {
        $builder->add('title', TextType::class);
        return $this;
    }

    private function buildDescription(FormBuilderInterface $builder): PageEntityType
    {
        $builder->add('description', TextareaType::class);
        return $this;
    }

    private function buildContent(FormBuilderInterface $builder): PageEntityType
    {
        $builder->add('content', TextareaType::class);
        return $this;
    }

    private function buildThumbnail(FormBuilderInterface $builder): PageEntityType
    {
        $builder->add('thumbnail', FileType::class, [
            'data_class' => null
        ]);

        return $this;
    }

    private function buildCategories(FormBuilderInterface $builder): PageEntityType
    {
        $builder->add('categories', EntityType::class, [
            'class'         => Category::class,
            'query_builder' => function (EntityRepository $entityRepository) {
                return $entityRepository->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
            },
            'label'  => 'Categories',
            'choice_label' => function(Category $category) {
                return $category->getName();
            },
            'multiple'      => true,
            'choice_value'  => function(?Category $category) {
                return $category ? $category->getName() : '';
            },
            'expanded' => true
        ]);

        return $this;
    }

    private function buildTags(FormBuilderInterface $builder): PageEntityType
    {
        $builder->add('tags', EntityType::class, [
            'class'         => Tag::class,
            'query_builder' => function (EntityRepository $entityRepository) {
                return $entityRepository->createQueryBuilder('t')
                    ->orderBy('t.name', 'ASC');
            },
            'label'  => 'Tags',
            'choice_label' => function(Tag $tag) {
                return $tag->getName();
            },
            'multiple'      => true,
            'expanded' => true
        ]);

        return $this;
    }

}
