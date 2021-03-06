<?php

namespace ClientBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use ClientBundle\Entity\Client;

/**
 * Class ClientAdmin
 */
class ClientAdmin extends AbstractAdmin
{
    /**
     * @param mixed $object
     * @return string
     */
    public function toString($object)
    {
        return $object instanceof Client
            ? $object->getDisplayName()
            : 'Client';
    }

    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection)
    {
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('дати', array('class' => 'col-md-4'))
                ->add('createdAt', 'date', ['widget' => 'text', 'required' => false, 'format' => 'd M y', 'disabled' => true])
                ->add('birthday', 'birthday', ['format' => 'd M y', 'placeholder' => 'd m y', 'widget' => 'text', 'required' => false])
            ->end()
            ->with('фіо', array('class' => 'col-md-8'))
                ->add('firstname', 'text')
                ->add('surname', 'text', ['required' => false])
            ->end()
            ->add('description', 'text', ['required' => false])
            ->add('categories', 'sonata_type_model', ['multiple' => true, 'required' => false])
/*
            ->add('categories','entity', array(
                'class' => 'ClientBundle:Category',
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false
                ))
*/
            ->add('language', 'sonata_type_model', ['multiple' => false])
            ->add('contacts', 'sonata_type_model', ['multiple' => true, 'required' => false]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('createdAt', null, array(), 'date', array('format' => 'd M y' ))
            ->add('firstname')
            ->add('surname')
            ->add('birthday', null, array(), 'birthday', array('widget' => 'text', 'format' => 'd M y' ))
            ->add('categories', null, array(), 'entity', null, array(
                'class' => 'ClientBundle:Category',
                'choice_label' => 'name',
            ))
            ->add('language', null, array(), 'entity', null, ['class' => 'ClientBundle:Lang', 'choice_label' => 'name']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('createdAt', 'date', ['format' => 'd-m-Y'])
            ->addIdentifier('getDisplayName')
            ->add('language.name')
        ;
    }
}
