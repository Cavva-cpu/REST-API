<?php
namespace Services\JsonNoteRepository;
use Dto\NoteDto;
interface NoteRepositoryInterface
{
    /**
     * Get note
     * @return array|string
     */
    public function GetAllNotes():array|string;


    /**
     * Create note
     *
     * @param $note
     * @return array|string
     */
    public function CreateNote(string $note):array|string;


    /**
     * Put note
     *
     * @param $id
     * @param $note
     * @return array|string
     */
    public function PutNote(int $id , string $note):array|string;


    /**
    * Delete note
     *
     * @param $noteId
     * @return bool|string
    */
    public function DeleteNote(int $noteId):bool|string;
}