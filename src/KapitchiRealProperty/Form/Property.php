<?php
/**
 * Kapitchi Zend Framework 2 Modules (http://kapitchi.com/)
 *
 * @copyright Copyright (c) 2012-2013 Kapitchi Open Source Team (http://kapitchi.com/open-source-team)
 * @license   http://opensource.org/licenses/LGPL-3.0 LGPL 3.0
 */

namespace KapRealProperty\Form;

use KapitchiBase\Form\EventManagerAwareForm;

/**
 *
 * @author Matus Zeman <mz@kapitchi.com>
 */
class Property extends EventManagerAwareForm
{
    protected $typeService;

    public function __construct($typeService)
    {
        parent::__construct();
        $this->setTypeService($typeService);
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
            'options' => array(
                'label' => 'ID',
            ),
        ));
        
        $this->add(array(
            'name' => 'typeId',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Type',
                'value_options' => $this->createTypeValueOptions()
            ),
        ));
        
        $this->add(array(
            'name' => 'addressId',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Address',
            ),
            'attributes' => array(
                'data-kap-ui' => 'address-lookup-input',
            )
        ));
        
        $this->add(array(
            'name' => 'title',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Title',
            ),
        ));
        
        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Description',
            ),
        ));

    }

    protected function createTypeValueOptions()
    {
        $options = $this->getTypeService()->getPaginator();
        $ret = array();
        foreach($options as $option) {
            $ret[$option->getId()] = $option->getLabel();
        }
        return $ret;
    }
            
    public function getTypeService()
    {
        return $this->typeService;
    }

    public function setTypeService($typeService)
    {
        $this->typeService = $typeService;
    }

}