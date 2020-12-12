<?php

namespace App\Form;

use App\Entity\Shop;
use App\Entity\ShopCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('shopCategories', EntityType::class, [
                    'class' => ShopCategory::class,
                    'label' => 'Catégorie',
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                    'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shop::class,
            'csrf_protection' => false,
        ]);
    }
}
