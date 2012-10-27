<?php

namespace Lrt\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lrt\SiteBundle\Enum\StatusArticleEnum;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $statusArticleEnum = new StatusArticleEnum();

        $builder
            ->add('title')
            ->add('content')
            ->add('status', 'choice', array(
                'label' => 'Status',
                'choices' => $statusArticleEnum->getData()))
            ->add('isPublic')
            ->add('category')
            ->add('user')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lrt\SiteBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'lrt_sitebundle_articletype';
    }
}
