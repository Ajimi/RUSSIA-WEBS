<?php

namespace Forum\ForumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                ->add('content',TextareaType::class)
                ->add('file',FileType::class,array(
                    'required'=>false
                ))
                ->add('etat',ChoiceType::class,array(
                    'choices'=>array('Waiting'=>'Waiting','Accept'=>'Accept','Refuse'=>'Refuse'),
                    'multiple'=>false
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Forum\ForumBundle\Entity\Subject'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'forum_forumbundle_subject';
    }


}
