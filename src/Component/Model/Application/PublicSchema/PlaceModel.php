<?php

namespace Component\Model\Application\PublicSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Component\Model\Application\PublicSchema\AutoStructure\Place as PlaceStructure;
use Component\Model\Application\PublicSchema\Place;

/**
 * PlaceModel
 *
 * Model class for table place.
 *
 * @see Model
 */
class PlaceModel extends Model
{
    use WriteQueries;

    /**
     * __construct()
     *
     * Model constructor
     *
     * @access public
     */
    public function __construct()
    {
        $this->structure             = new PlaceStructure;
        $this->flexible_entity_class = '\Component\Model\Application\PublicSchema\Place';
    }

    public function findOneWithDetails(Where $where)
    {
        $sql        = <<<SQL
select
    :projection
from
    :place place
left join :price price ON place.id = price.place_id
where :condition
GROUP BY place.id
LIMIT 1
SQL;
        $projection = $this
            ->createProjection()
            ->setField('prices', 'array_agg(price)', '\Component\Model\Application\PublicSchema\Price[]');

        $sql    = strtr($sql,
            [
                ':projection' => $projection->formatFieldsWithFieldAlias('place'),
                ':place'      => $this->getStructure()->getRelation(),
                ':price'      => $this
                    ->getSession()
                    ->getModel('\Component\Model\Application\PublicSchema\PriceModel')
                    ->getStructure()
                    ->getRelation(),
                ':condition'  => $where,
            ]
        );
        $result = $this->query($sql, $where->getValues(), $projection);

        return $result;
    }
}
