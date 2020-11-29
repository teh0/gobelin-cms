<?php

namespace App\Form;

use App\Entity\SearchField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->buildField($builder, $options)
            ->buildValue($builder)
            ->buildSubmitButton($builder);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchField::class,
            'choices'    => null
        ]);
    }

    private function buildField(FormBuilderInterface $builder, array $options): SearchFieldType
    {
        $builder->add('field', ChoiceType::class, [
            'choices' => $options['choices'],
            'label'   => false
        ]);

        return $this;
    }

    private function buildValue(FormBuilderInterface $builder): SearchFieldType
    {
        $builder->add('value', TextType::class, [
            'required' => false,
            'label'    => false
        ]);

        return $this;
    }

    private function buildSubmitButton(FormBuilderInterface $builder): SearchFieldType
    {
        $builder->add('Search', SubmitType::class);

        return $this;
    }

    public static function categoryChoices(): array
    {
        return ['Par nom' => 'name'];
    }

    public static function pageChoices(): array
    {
        return [
            'Par titre'       => 'title',
            'Par description' => 'description',
            'Par contenu'     => 'content'
        ];
    }

    public static function tagChoices(): array
    {
        return ['Par nom' => 'name'];
    }

    public static function userChoices(): array
    {
        return [
            'Par nom'    => 'name',
            'Par pseudo' => 'pseudo'
        ];
    }
}
