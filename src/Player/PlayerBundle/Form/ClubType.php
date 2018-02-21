<?php

namespace Player\PlayerBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('clubName')->add('seasonStart')
            ->add('seasonEnd')->add('matchPlayer')
            ->add('goalScored')->add('player',
                EntityType::class,array(
                    'class' => 'PlayerBundle:Player',
                    'choice_label' => 'name', 'multiple' => false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Player\PlayerBundle\Entity\Club'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'player_playerbundle_club';
    }


}
