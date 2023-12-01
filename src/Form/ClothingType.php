<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Clothing;
use App\Entity\Brand;
use App\Entity\Size;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class ClothingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Clothing Name', 
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true, 
                'expanded' => true, 
                'by_reference' => false,
                'constraints' => [
                    new Count(['min' => 1, 'minMessage' => 'Please choose at least one category.'])
                ]
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
            ])
            ->add('sizes', EntityType::class, [
                'class' => Size::class,
                'choice_label' => 'name',
                'multiple' => true, 
                'expanded' => true, 
                'by_reference' => false,
                'constraints' => [
                    new Count(['min' => 1, 'minMessage' => 'Please choose at least one size.'])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clothing::class,
        ]);
    }
}
