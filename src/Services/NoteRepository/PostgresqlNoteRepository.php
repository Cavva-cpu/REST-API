<?php

namespace Services\NoteRepository;

use PDOException;
use Services\NoteRepository\NoteRepositoryInterface;


class PostgresqlNoteRepository implements NoteRepositoryInterface
{

    private string $dbName = 'YOUR_DATABASE_NAME';
    public  function getAllNotes(): array
    {
        $dbh = "host=localhost port=5432 dbname={$this->dbName} user=YOUR_LOGIN password=YOUR_PASSWORD";
        try {
            $conection = pg_connect($dbh);
        }catch (PDOException $e){
            echo $e->getMessage();
        }

        $migration = pg_query($conection, "SELECT * FROM notes");
        $allNotes = pg_fetch_all($migration);
        $return = array_map(function (array $notes) {
            return "note {$notes['id']}: {$notes['note']}";
        } , $allNotes);
        return $return;
    }


    public function createNote(string $note): array
    {
        $dbh = "host=localhost port=5432 dbname={$this->dbName} user=YOUR_LOGIN password=YOUR_PASSWORD";
        try {
            $conection = pg_connect($dbh);
        }catch (PDOException $e){
            echo $e->getMessage();
        }

        $migration = pg_query($conection, "INSERT INTO notes (note,done) values ('$note', true)");
        return $Note = pg_fetch_all($migration);
    }


    public function putNote(int $id, string $note): array
    {
        $dbh = "host=localhost port=5432 dbname={$this->dbName} user=YOUR_LOGIN password=YOUR_PASSWORD";
        try {
            $conection = pg_connect($dbh);
        }catch (PDOException $e){
            echo $e->getMessage();
        }

        $migration = pg_query($conection, "UPDATE notes SET note = '$note' WHERE id = '$id'");
        return $Note = pg_fetch_all($migration);
    }


    public function deleteNote(int $noteId): bool
    {
        $dbh = "host=localhost port=5432 dbname={$this->dbName} user=YOUR_LOGIN password=YOUR_PASSWORD";
        try {
            $conection = pg_connect($dbh);
        }catch (PDOException $e){
            echo $e->getMessage();
        }

        try {
            $migration = pg_query($conection, "DELETE FROM notes WHERE id = '$noteId'");
            return true;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }


    }
}
