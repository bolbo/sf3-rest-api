<?php
/**
 * AccountRepository.php
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


use Component\Model\Application\PublicSchema\Account;
use PommProject\Foundation\Pomm;

class AccountRepository extends BaseRepository
{
    /**
     * LeadRepository constructor.
     * @param $class
     * @param Pomm $pomm
     */
    public function __construct(
        $class,
        Pomm $pomm
    )
    {
        parent::__construct($class, $pomm);
    }


    /**
     * Utilisé pour l'autocompletion de l'IDE
     *
     * @return \Component\Model\Application\PublicSchema\AccountModel
     */
    public function getPommModel()
    {
        return $this->getModel();
    }

    /**
     * @return \PommProject\ModelManager\Model\CollectionIterator
     */
    public function findAll()
    {
        return $this->getPommModel()->findAll();
    }

    public function find($accountId)
    {
        return $this->getPommModel()->findByPK(['id' => (int)$accountId]);
    }

    public function insert(array $data)
    {
        /** @var Account $lead */
        $lead = $this->getPommModel()->createAndSave($data);

        return $this->find($lead->getId());
    }


    public function delete(int $accountId)
    {
        $this->getPommModel()->deleteByPK(['id' => $accountId]);
    }

    public function update($accountId, array $data)
    {
        return $this->getPommModel()->updateByPk(["id" => $accountId], $data);

    }
}