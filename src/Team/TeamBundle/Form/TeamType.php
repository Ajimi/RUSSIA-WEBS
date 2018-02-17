<?php

namespace Team\TeamBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('teamName')->add('teamLogo',FileType::class)
            ->add('teamShortcut')->add('matchPlayed')
            ->add('matchWon')->add('matchLost')->add('goalScored')
            ->add('goalIn')->add('matchDraw')->add('participation')
            ->add('winner')->add('second')->add('third')
            ->add('create', SubmitType::class);;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Team\TeamBundle\Entity\Team'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'team_teambundle_team';
    }


}
