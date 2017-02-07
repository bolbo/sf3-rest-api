<?php
/**
 * Account.php
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


/**
 * Class Account
 * @package Business\Model
 */
class Account
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $firstname;
    /**
     * @var
     */
    private $lastname;
    /**
     * @var
     */
    private $email;

    /**
     * Account constructor.
     */
    public function __construct(array $data)
    {
        $this->firstname = $data['firstname']??'';;
        $this->lastname = $data['lastname']??'';;
        $this->email = $data['email']??'';;
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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     * @return Account
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     * @return Account
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Account
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }


}