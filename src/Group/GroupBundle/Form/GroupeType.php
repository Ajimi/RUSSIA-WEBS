<?php

namespace Group\GroupBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('team1', EntityType::class, array(
                'class' => 'TeamBundle:Team',
                'choice_label' => 'teamName', 'multiple' => false))
            ->add('team2', EntityType::class, array(
                'class' => 'TeamBundle:Team',
                'choice_label' => 'teamName', 'multiple' => false))
            ->add('team3', EntityType::class, array(
                'class' => 'TeamBundle:Team',
                'choice_label' => 'teamName', 'multiple' => false))
            ->add('team4', EntityType::class, array(
                'class' => 'TeamBundle:Team',
                'choice_label' => 'teamName', 'multiple' => false))
            ->add('create', SubmitType::class);;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Group\GroupBundle\Entity\Groupe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'group_groupbundle_groupe';
    }


}
