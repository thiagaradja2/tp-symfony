<?php

namespace App\Form;

use App\Entity\Dish;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',TextType::class,array('required' => true))
            ->add('Calories')
            ->add('Price',NumberType::class,array('required' => true))
            ->add('Image', null,array('required'=> false,'empty_data' => 'http://via.placeholder.com/360x225'))
            ->add('Description',TextType::class,array('required' => true))
            ->add('Sticky')
            ->add('Category',null,array('required' => true))
            ->add('User')
            ->add('allergens')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dish::class,
        ]);
    }

    public function _availableCalories()
    {
        $calories = array();
        for ($i = 10; $i <= 300; $i += 10)
            $calories [$i] = $i;
        return $calories;
    }

}
