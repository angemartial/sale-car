<?php

namespace AppBundle\Form;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Comfort;
use AppBundle\Entity\Dealer;
use AppBundle\Entity\Energy;
use AppBundle\Entity\Media;
use AppBundle\Entity\Security;
use AppBundle\Entity\State;
use AppBundle\Entity\Transmission;
use AppBundle\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model',null, [
        'attr' =>[
            'class' => 'm-firstSelects'
        ],
        'label' => 'Modèl'
    ])
            ->add('year',null, [
        'attr' =>[
            'class' => 'm-firstSelects'
        ],
        'label' => 'Année'
    ])
            ->add('images',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Images'
            ])
            ->add('textDescription',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Description'
            ])

            ->add('kilometers',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Kilométrage'
            ])
            ->add('exteriorColour',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Couleur extérieure'
            ])
            ->add('interiorColour',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Couleur intérieure'
            ])
            ->add('place',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Nbre de places'
            ])
            ->add('cylindre',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Cylindre'
            ])
            ->add('door',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Portes'
            ])
            ->add('price',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Prix'
            ])
            ->add('location',null, [
                'attr' =>[
                    'class' => 'm-select'
                ],
                'label' => 'Localisation'
            ])
            ->add('comfort',null, [
                'label' => 'Confort'
            ])
            ->add('type',null, [
                'label' => 'Type'
            ])

            ->add('state',null, [
                'label' => 'Etat'
            ])
            ->add('medias',null, [
                 'label' => 'Médias'
            ])
            ->add('securities',null, [
                 'label' => 'Sécurité'
            ])
            ->add('transmission',null, [
                 'label' => 'Transmission'
            ])
            ->add('energy',null, [
                'label' => 'Energie'
            ])
            ->add('brand',null, [
                'label' => 'Marque'
            ])
            ->add('dealer', DealerType::class, [
                'label' => 'Vendeur'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn m-btn pull-right'
                ],
                'label' => ''
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Vehicle'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_vehicle';
    }


}
