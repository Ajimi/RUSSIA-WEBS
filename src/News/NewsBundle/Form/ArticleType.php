<?php

namespace News\NewsBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use News\NewsBundle\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', CKEditorType::class, array(
                'config_name' => 'my_config',
                'config' => array(
                    'extraPlugins' => 'youtube',
                )
            )
        )->add('title', TextType::class, array(
            'attr' => array(
                'required' => true,
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Article::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'news_newsbundle_article';
    }


}
