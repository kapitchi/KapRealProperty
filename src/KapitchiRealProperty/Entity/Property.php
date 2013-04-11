<?php
namespace KapitchiRealProperty\Entity;
/**
 *
 * @author Matus Zeman <mz@kapitchi.com>
 */
class Property
{
    protected $id;
    protected $typeId;
    protected $title;
    protected $description;
    protected $addressId;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }

    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getAddressId()
    {
        return $this->addressId;
    }

    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;
    }
    
}