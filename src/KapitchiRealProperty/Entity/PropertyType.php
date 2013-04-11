<?php
namespace KapitchiRealProperty\Entity;
/**
 *
 * @author Matus Zeman <mz@kapitchi.com>
 */
class PropertyType
{
    protected $id;
    protected $label;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

}