<?php

namespace Player\PlayerBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('playerName')->add('playerLastName')
            ->add('file',FileType::class,array('required' => false))->add('playerPosition')
            ->add('birthday')->add('weight')->add('height')
            ->add('totalGames')->add('bio')->add('team')
            ->add('nationalTeam',EntityType::class,array(
                'class' => 'TeamBundle:Team',
                'choice_label' => 'teamName', 'multiple' => false))
            ->add('create', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Player\PlayerBundle\Entity\Player'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'player_playerbundle_player';
    }


}
