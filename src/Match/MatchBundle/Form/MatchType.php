<?php

namespace Match\MatchBundle\Form;

use Match\MatchBundle\Entity\TeamTest;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teamName1',EntityType::class,
                array(
                    'class'=>'MatchBundle:TeamTest'))
            ->add('teamName2',EntityType::class,
                array(
                    'class'=>'MatchBundle:TeamTest'))
            ->add('level')
            ->add('date')
            ->add('time')
        ->add('stadium');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Match\MatchBundle\Entity\Match'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'match_matchbundle_match';
    }


}
