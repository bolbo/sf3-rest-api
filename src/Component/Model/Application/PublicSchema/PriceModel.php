<?php

namespace Component\Model\Application\PublicSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Component\Model\Application\PublicSchema\AutoStructure\Price as PriceStructure;
use Component\Model\Application\PublicSchema\Price;

/**
 * PriceModel
 *
 * Model class for table price.
 *
 * @see Model
 */
class PriceModel extends Model
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
        $this->structure = new PriceStructure;
        $this->flexible_entity_class = '\Component\Model\Application\PublicSchema\Price';
    }
}
