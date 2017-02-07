<?php
/**
 * BaseRepository.php
 *
 * PHP version 7
 *
 * LICENSE: SISMIC
 *
 * @category  CategoryName
 * @package AppBundle\Repository
 * @author    Laurent BOLZER <lbolzer_at_sismic.fr>
 */

namespace AppBundle\Repository;


use PommProject\Foundation\Pomm;
use PommProject\Foundation\Where;
use PommProject\ModelManager\ModelLayer\ModelLayer;

/**
 * @author Mikael Paris <stood86@gmail.com>
 */
abstract class BaseRepository extends ModelLayer
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var Pomm
     */
    protected $pomm;

    /**
     * @var string
     */
    protected $nameSession;

    /**
     * BaseRepository constructor.
     * @param      $class
     * @param Pomm $pomm
     * @param null $nameSession
     */
    public function __construct($class, Pomm $pomm, $nameSession = null)
    {
        $this->class       = $class;
        $this->pomm        = $pomm;
        $this->nameSession = $nameSession;
    }

    /**
     * @return \PommProject\Foundation\Session\Session
     * @throws \PommProject\Foundation\Exception\FoundationException
     */
    protected function getSession()
    {
        return $this->pomm->getDefaultSession();
    }

    /**
     * @param string $identifier
     * @return \PommProject\ModelManager\Model\Model
     */
    public function getModel($identifier = "")
    {
        if ($identifier != "") return parent::getModel($identifier);

        return $this->getSession()->getModel($this->class);
    }

    /**
     * @param Where $where
     * @param $condition
     * @param $value
     * @return Where
     */
    public function addCriteria(Where $where, $condition, $value = null)
    {
        if (!is_null($value)) {
            $newCriteria = Where::create($condition, [$value]);
        } else {
            $newCriteria = Where::create($condition);
        }

        return $newCriteria->andWhere($where);
    }

}