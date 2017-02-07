<?php
/**
 * This file has been automatically generated by Pomm's generator.
 * You MIGHT NOT edit this file as your changes will be lost at next
 * generation.
 */

namespace Component\Model\Application\PublicSchema\AutoStructure;

use PommProject\ModelManager\Model\RowStructure;

/**
 * Place
 *
 * Structure class for relation public.place.
 * 
 * Class and fields comments are inspected from table and fields comments.
 * Just add comments in your database and they will appear here.
 * @see http://www.postgresql.org/docs/9.0/static/sql-comment.html
 *
 *
 *
 * @see RowStructure
 */
class Place extends RowStructure
{
    /**
     * __construct
     *
     * Structure definition.
     *
     * @access public
     */
    public function __construct()
    {
        $this
            ->setRelation('public.place')
            ->setPrimaryKey(['id'])
            ->addField('id', 'int4')
            ->addField('name', 'varchar')
            ->addField('address', 'text')
            ;
    }
}
