<?php
namespace Services\Repository;
use Dto\NoteDto;
interface NoteRepositoryInterface
{
    /**
     * Get note
     * @return array
     */
    public function GetAllNotes():array;


    /**
     * Create note
     *
     * @param $dataRequest
     * @return array
     */
    public function CreateNote(string $note):array;


    /**
     * Put note
     *
     * @param $dataRequest
     * @param $noteId
     */
    public function PutNote(int $id , string $note):array;


    /**
    * Delete note
     *
     * @param $noteId
     * @return bool
    */
    public function DeleteNote(int $noteId):bool;
}