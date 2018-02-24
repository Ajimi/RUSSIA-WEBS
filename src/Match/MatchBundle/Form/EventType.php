<?php

namespace Match\MatchBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minutes')
            ->add('typeEvent', ChoiceType::class, array(
                'placeholder' => 'Choose an event',
                'multiple' => false,
                'choices' => array(
                    'Goal' => 'Goal',
                    'Shot(On Target)' => 'Shot(On Target)',
                    'Save' => 'Save',
                    'Corner Kick' => 'Corner Kick',
                    'Penalty Kick' => 'Penalty Kick',
                    'Yellow Card' => 'Yellow Card',
                    'Red Card' => 'Red Card'
                )))
            ->add('description', TextareaType::class)
            ->add('player', EntityType::class, array(
                'class' => 'Player\PlayerBundle\Entity\Player',
                'choice_label' => 'playerName'
            ))
            ->add('save', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Match\MatchBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'match_matchbundle_event';
    }


}
