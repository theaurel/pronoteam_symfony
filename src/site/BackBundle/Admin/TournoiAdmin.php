<?php

namespace site\BackBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TournoiAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('place', 'text')
                    ->add('nb_players', 'text')
                    ->add('status', 'text')
                    ->add('date', 'date');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('date');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('date');
    }
}
