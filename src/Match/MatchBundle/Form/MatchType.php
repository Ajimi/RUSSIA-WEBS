<?php

namespace Match\MatchBundle\Form;

use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('team1', EntityType::class,
                array(
                    'class' => 'Team\TeamBundle\Entity\Team',
                    'choice_label' => 'teamName'))
            ->add('team2', EntityType::class,
                array(
                    'class' => 'Team\TeamBundle\Entity\Team',
                    'choice_label' => 'teamName'))
            ->add('level', ChoiceType::class, array(
                'choices' => array('Round of 16' => 'Round of 16',
                    'Quarter finals' => 'Quarter finals',
                    'Semi Finals' => 'Semi Finals',
                    'Final' => 'Final',
                    'Play off for Third Place' => 'Play off for Third Place'),
                'multiple' => false))
            ->add('date')
            ->add('time')
            ->add('stadium')
            ->add('create', SubmitType::class);
    }

    /**
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
