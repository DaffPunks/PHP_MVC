<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class Feedbacks extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('feedbacks');
        $table->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('text', 'text')
            ->addColumn('created', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('edited', 'boolean', array('default' => false))
            ->addColumn('status', 'integer', array('default' => 0, 'limit' => MysqlAdapter::INT_TINY)) //0 - Waiting moderate, 1 - Accepted, 2 - Rejected
            ->create();
    }
}
