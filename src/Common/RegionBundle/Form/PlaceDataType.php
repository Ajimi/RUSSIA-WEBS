<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/27/2018
 * Time: 10:09 AM
 */

namespace Common\RegionBundle\Form;


use Common\RegionBundle\Entity\Category;
use Common\RegionBundle\Entity\Place;
use Common\RegionBundle\Entity\Region;
use Common\RegionBundle\Modal\PlaceData;
use Common\RegionBundle\Repository\CategoryRepository;
use Common\RegionBundle\Repository\PlaceRepository;
use Common\RegionBundle\Repository\RegionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PlaceDataType
 * @package Common\RegionBundle\Form
 */
class PlaceDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('information')
            ->add('previewText', TextType::class)
            ->add('previewPicture')
            ->add('phone')
            ->add('siteUrl')
            ->add('region', EntityType::class, array(
                'class' => Region::class,
                'placeholder' => 'Select the Region',
                'attr' => array(
                    'id' => 'js-region-select'
                ),
                'query_builder' => function (RegionRepository $repo) {
                    return $repo->getBuilder();
                }
            ))
            ->add('category', EntityType::class, array(
                'class' => Category::class,
                'placeholder' => 'Select place category',
                'attr' => array(
                    'id' => 'js-category-select'
                ),
                'query_builder' => function (CategoryRepository $repo) {
                    return $repo->getBuilder();
                }
            ))
            ->add('longitude', TextType::class,
                array(
                    'attr' => array(
                        'class' => 'js-lng',
                        'required' => true
                    ),
                )
            )->add('latitude', TextType::class,
                array(
                    'attr' => array(
                        'class' => 'js-lat'
                    ),
                )
            );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => PlaceData::class
        ));
    }

    public function getBlockPrefix()
    {
        return 'place_data';
    }


}