<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/21/2018
 * Time: 1:44 PM
 */

namespace Common\RegionBundle\Form;


use Common\RegionBundle\Modal\RegionData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegionDataType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('regionName')
            ->add('longitude', TextType::class,
                array(
                    'attr' => array(
                        'class' => 'js-lng'
                    ),
                )
            )
            ->add('latitude', TextType::class,
                array(
                    'attr' => array(
                        'class' => 'js-lat'
                    ),
                )
            );
    }

    /**
     * {@inheritdoc}
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => RegionData::class
        ));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'common_regionbundle_region';
    }


}