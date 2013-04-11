<?php

namespace KapitchiRealProperty;

use Zend\EventManager\EventInterface,
    Zend\ModuleManager\Feature\ControllerProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\ModuleManager\Feature\ViewHelperProviderInterface,
	KapitchiBase\ModuleManager\AbstractModule,
    KapitchiEntity\Mapper\EntityDbAdapterMapper,
    KapitchiEntity\Mapper\EntityDbAdapterMapperOptions;

class Module extends AbstractModule
    implements ServiceProviderInterface, ControllerProviderInterface, ViewHelperProviderInterface
{

	public function onBootstrap(EventInterface $e) {
		parent::onBootstrap($e);
		
        
	}
    
    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'Teccx\Controller\Index' => function($sm) {
                    $ins = new Controller\TestController();
                    return $ins;
                },
            )
        );
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'realproperty' => function($sm) {
                    $ins = new View\Helper\Property(
                            $sm->getServiceLocator()->get('KapitchiRealProperty\Service\Property')
                        );
                    return $ins;
                },
            )
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'KapitchiRealProperty\Entity\Property' => 'KapitchiRealProperty\Entity\Property',
                'KapitchiRealProperty\Entity\PropertyType' => 'KapitchiRealProperty\Entity\PropertyType',
            ),
            'factories' => array(
                'KapitchiRealProperty\Service\Property' => function ($sm) {
                    $ins = new Service\Property(
                        $sm->get('KapitchiRealProperty\Mapper\PropertyDbAdapter'),
                        $sm->get('KapitchiRealProperty\Entity\Property'),
                        $sm->get('KapitchiRealProperty\Entity\PropertyHydrator')
                    );
                    return $ins;
                },
                'KapitchiRealProperty\Mapper\PropertyDbAdapter' => function ($sm) {
                    return new EntityDbAdapterMapper(
                        $sm->get('Zend\Db\Adapter\Adapter'),
                        new EntityDbAdapterMapperOptions(array(
                            'tableName' => 'realproperty_property',
                            'primaryKey' => 'id',
                            'hydrator' => $sm->get('KapitchiRealProperty\Entity\PropertyHydrator'),
                            'entityPrototype' => $sm->get('KapitchiRealProperty\Entity\Property'),
                        ))
                    );
                },
                'KapitchiRealProperty\Entity\PropertyHydrator' => function ($sm) {
                    return new Entity\PropertyHydrator(false);
                },
                'KapitchiRealProperty\Form\PropertyInputFilter' => function ($sm) {
                    $ins = new Form\PropertyInputFilter();
                    return $ins;
                },
                'KapitchiRealProperty\Form\Property' => function ($sm) {
                    $ins = new Form\Property($sm->get('KapitchiRealProperty\Service\PropertyType'));
                    $ins->setInputFilter($sm->get('KapitchiRealProperty\Form\PropertyInputFilter'));
                    return $ins;
                },
                'KapitchiRealProperty\Service\PropertyType' => function ($sm) {
                    $ins = new Service\PropertyType(
                        $sm->get('KapitchiRealProperty\Mapper\PropertyTypeDbAdapter'),
                        $sm->get('KapitchiRealProperty\Entity\PropertyType'),
                        $sm->get('KapitchiRealProperty\Entity\PropertyTypeHydrator')
                    );
                    return $ins;
                },
                'KapitchiRealProperty\Mapper\PropertyTypeDbAdapter' => function ($sm) {
                    return new EntityDbAdapterMapper(
                        $sm->get('Zend\Db\Adapter\Adapter'),
                        new EntityDbAdapterMapperOptions(array(
                            'tableName' => 'realproperty_property_type',
                            'primaryKey' => 'id',
                            'hydrator' => $sm->get('KapitchiRealProperty\Entity\PropertyTypeHydrator'),
                            'entityPrototype' => $sm->get('KapitchiRealProperty\Entity\PropertyType'),
                        ))
                    );
                },
                'KapitchiRealProperty\Entity\PropertyTypeHydrator' => function ($sm) {
                    return new \Zend\Stdlib\Hydrator\ClassMethods(false);
                },
                
                
            )
        );
    }
    
    public function getDir() {
        return __DIR__;
    }

    public function getNamespace() {
        return __NAMESPACE__;
    }

}