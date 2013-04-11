<?php
namespace KapitchiRealProperty\Entity;

/**
 *
 * @author Matus Zeman <mz@kapitchi.com>
 */
class PropertyInputFilter extends \KapitchiBase\InputFilter\EventManagerAwareInputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name'       => 'id',
            'required'   => false,
        ));
        $this->add(array(
            'name'       => 'typeId',
            'required'   => true,
        ));
        $this->add(array(
            'name'       => 'addressId',
            'required'   => true,
        ));
        $this->add(array(
            'name'       => 'title',
            'required'   => true,
        ));
        $this->add(array(
            'name'       => 'description',
            'required'   => false,
        ));
    }
}