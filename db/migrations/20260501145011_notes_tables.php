<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class NotesTables extends AbstractMigration
{
    public function change(): void
    {
        // Было $tihs, нужно $this
        $table = $this->table('notes'); 
        $table->addColumn('note', 'text')
              ->addColumn('done', 'boolean')
              ->create();
    }
}