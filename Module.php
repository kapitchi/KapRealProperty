<?php
/**
 * Kapitchi Zend Framework 2 Modules (http://kapitchi.com/)
 *
 * @copyright Copyright (c) 2012-2013 Kapitchi Open Source Team (http://kapitchi.com/open-source-team)
 * @license   http://opensource.org/licenses/LGPL-3.0 LGPL 3.0
 */

namespace KapRealProperty;

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
                            $sm->getServiceLocator()->get('KapRealProperty\Service\Property')
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
                'KapRealProperty\Entity\Property' => 'KapRealProperty\Entity\Property',
                'KapRealProperty\Entity\PropertyType' => 'KapRealProperty\Entity\PropertyType',
            ),
            'factories' => array(
                'KapRealProperty\Service\Property' => function ($sm) {
                    $ins = new Service\Property(
                        $sm->get('KapRealProperty\Mapper\PropertyDbAdapter'),
                        $sm->get('KapRealProperty\Entity\Property'),
                        $sm->get('KapRealProperty\Entity\PropertyHydrator')
                    );
                    return $ins;
                },
                'KapRealProperty\Mapper\PropertyDbAdapter' => function ($sm) {
                    return new EntityDbAdapterMapper(
                        $sm->get('Zend\Db\Adapter\Adapter'),
                        new EntityDbAdapterMapperOptions(array(
                            'tableName' => 'realproperty_property',
                            'primaryKey' => 'id',
                            'hydrator' => $sm->get('KapRealProperty\Entity\PropertyHydrator'),
                            'entityPrototype' => $sm->get('KapRealProperty\Entity\Property'),
                        ))
                    );
                },
                'KapRealProperty\Entity\PropertyHydrator' => function ($sm) {
                    return new Entity\PropertyHydrator(false);
                },
                'KapRealProperty\Form\PropertyInputFilter' => function ($sm) {
                    $ins = new Form\PropertyInputFilter();
                    return $ins;
                },
                'KapRealProperty\Form\Property' => function ($sm) {
                    $ins = new Form\Property($sm->get('KapRealProperty\Service\PropertyType'));
                    $ins->setInputFilter($sm->get('KapRealProperty\Form\PropertyInputFilter'));
                    return $ins;
                },
                'KapRealProperty\Service\PropertyType' => function ($sm) {
                    $ins = new Service\PropertyType(
                        $sm->get('KapRealProperty\Mapper\PropertyTypeDbAdapter'),
                        $sm->get('KapRealProperty\Entity\PropertyType'),
                        $sm->get('KapRealProperty\Entity\PropertyTypeHydrator')
                    );
                    return $ins;
                },
                'KapRealProperty\Mapper\PropertyTypeDbAdapter' => function ($sm) {
                    return new EntityDbAdapterMapper(
                        $sm->get('Zend\Db\Adapter\Adapter'),
                        new EntityDbAdapterMapperOptions(array(
                            'tableName' => 'realproperty_property_type',
                            'primaryKey' => 'id',
                            'hydrator' => $sm->get('KapRealProperty\Entity\PropertyTypeHydrator'),
                            'entityPrototype' => $sm->get('KapRealProperty\Entity\PropertyType'),
                        ))
                    );
                },
                'KapRealProperty\Entity\PropertyTypeHydrator' => function ($sm) {
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