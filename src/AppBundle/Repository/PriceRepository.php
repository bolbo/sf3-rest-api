<?php
/**
 * PriceRepository.php
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


use Component\Model\Application\PublicSchema\Price;
use PommProject\Foundation\Pomm;

class PriceRepository extends BaseRepository
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
     * @return \Component\Model\Application\PublicSchema\PriceModel
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

    public function find($priceId)
    {
        return $this->getPommModel()->findByPK(['id' => (int)$priceId]);
    }

    /**
     * @param array $data
     * @return \PommProject\ModelManager\Model\FlexibleEntity\FlexibleEntityInterface
     */
    public function insert(array $data)
    {
        /** @var Price $lead */
        $lead = $this->getPommModel()->createAndSave($data);

        return $this->find($lead->getId());
    }

    public function delete(int $priceId)
    {
        $this->getPommModel()->deleteByPK(['id' => $priceId]);
    }

    public function update($priceId, array $data)
    {
        return $this->getPommModel()->updateByPk(["id" => $priceId], $data);

    }

}