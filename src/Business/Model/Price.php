<?php
/**
 * Price.php
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


class Price
{
    private $id;
    private $type;
    private $value;
    private $place;

    public function __construct(array $data)
    {
        $this->type  = $data['type']??'';
        $this->value = $data['value']??0;
        $this->price = $data['place']??null;
    }

    /**
     * @return Place
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param Place $price
     * @return Price
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
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
     * @return Price
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Price
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Price
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     * @return Price
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }


}