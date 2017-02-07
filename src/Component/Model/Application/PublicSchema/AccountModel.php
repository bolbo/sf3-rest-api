<?php

namespace Component\Model\Application\PublicSchema;

use PommProject\ModelManager\Model\Model;
use PommProject\ModelManager\Model\Projection;
use PommProject\ModelManager\Model\ModelTrait\WriteQueries;

use PommProject\Foundation\Where;

use Component\Model\Application\PublicSchema\AutoStructure\Account as AccountStructure;
use Component\Model\Application\PublicSchema\Account;

/**
 * AccountModel
 *
 * Model class for table account.
 *
 * @see Model
 */
class AccountModel extends Model
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
        $this->structure = new AccountStructure;
        $this->flexible_entity_class = '\Component\Model\Application\PublicSchema\Account';
    }
}
