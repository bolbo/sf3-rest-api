<?php
/**
 * Place.php
 *
 * PHP version 7
 *
 * LICENSE: SISMIC
 *
 * @category  CategoryName
 * @package Business\Model
 * @author    Laurent BOLZER <lbolzer_at_sismic.fr>
 */

namespace Business\Model;


class Place
{
    /**
     * @var
     */
    private $id;
    private $name;

    private $address;

    public function __construct(array $data)
    {
        $this->name    = $data['name']??'';
        $this->address = $data['address']??'';
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Account
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Place
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return Place
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }


}