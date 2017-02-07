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
        $this->structure = new PlaceStructure;
        $this->flexible_entity_class = '\Component\Model\Application\PublicSchema\Place';
    }
}
