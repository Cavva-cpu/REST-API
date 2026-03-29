<?php
namespace Services\NoteRepository;

interface NoteRepositoryInterface
{
    /**
     * Get note
     *
     */
    public  function getAllNotes():array;


    /**
     * Create note
     *
     * @param $note
     * @return array
     */
    public function createNote(string $note):array;


    /**
     * Put note
     *
     * @param $id
     * @param $note
     * @return array
     */
    public function putNote(int $id , string $note):array;


    /**
    * Delete note
     *
     * @param $noteId
     * @return bool
    */
    public function deleteNote(int $noteId):bool;
}