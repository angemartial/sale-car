<?php
/**
 * Created by PhpStorm.
 * User: Eliket-Grp
 * Date: 05/09/2018
 * Time: 00:30
 */

namespace AppBundle\Form;


use AppBundle\Entity\Brand;
use AppBundle\Entity\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\VehicleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand',EntityType::class, [
                'label' => 'Marque',
                'class' =>  Brand::class,
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'select1',
                    'title' => 'marque',
                    'data-hide-disabled' => 'true',
                    'data-live-search' => 'true'
                ]
            ])

            ->add('state',EntityType::class, [
                'label' => 'Etat',
                'class' => State::class,
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'select3',
                    'title' => 'etat',
                    'data-hide-disabled' => 'true',
                    'data-live-search' => 'true'
                ]
            ])
            ->add('model', null, [
                "attr" => [
                    'placeholder' => 'model'
                ]
            ])
            ->add('minYear', null, [
                "attr" => [
                    'placeholder' => 'Année min'
                ]
            ])
            ->add('maxYear', null, [
                "attr" => [
                    'placeholder' => 'Année max'
                ]
            ])
            ->add('minPrice', null, [
                "attr" => [
                    'placeholder' => 'Prix min'
                ]
            ])
            ->add('maxPrice', null, [
                "attr" => [
                    'placeholder' => 'Prix max'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Extra\VehicleSearch'
        ));
    }

    public function getBlockPrefix()
    {
        return 'appbundle_vehiclesearch';
    }


}