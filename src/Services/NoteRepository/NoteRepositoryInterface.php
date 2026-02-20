<?php
namespace Services\NoteRepository;
use Dto\NoteDto;
interface NoteRepositoryInterface
{
    /**
     * Get note
     * @return array
     */
    public function GetAllNotes():array|string;


    /**
     * Create note
     *
     * @param $dataRequest
     * @return array
     */
    public function CreateNote(string $note):array|string;


    /**
     * Put note
     *
     * @param $dataRequest
     * @param $noteId
     */
    public function PutNote(int $id , string $note):array|string;


    /**
    * Delete note
     *
     * @param $noteId
     * @return bool
    */
    public function DeleteNote(int $noteId):bool|string;
}