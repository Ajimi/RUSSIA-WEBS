<?php

namespace Match\MatchBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatisticsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('team', EntityType::class, array(
                'class' => 'MatchBundle:TeamTest',
                'choice_label' => 'name'))
            ->add('match', EntityType::class, array(
                'class' => 'MatchBundle:Match',
                'choice_label' => 'level'
            ))
            ->add('shots')
            ->add('cornerKicks')
            ->add('saves')
            ->add('yellowCards')
            ->add('redCards');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Match\MatchBundle\Entity\Statistics'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'match_matchbundle_statistics';
    }


}
