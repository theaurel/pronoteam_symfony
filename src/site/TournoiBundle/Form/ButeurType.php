<?php

namespace site\TournoiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use site\TournoiBundle\Entity\ButeurRepository;

class ButeurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'entity', array(
            'class'    => 'siteTournoiBundle:Buteur',
            'property' => 'name',
            'query_builder' => function(ButeurRepository $repo) {
                return $repo->getPublishedQueryBuilder();
            },
            'multiple' => false
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'site\TournoiBundle\Entity\Buteur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_tournoibundle_buteur';
    }
}
