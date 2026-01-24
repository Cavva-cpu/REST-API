<?php
namespace Services\RepositoryInterface;
interface RepositoryInterface
{
    /**
     * Get note
     * @return string with all notes
     */
    public function GetAllNotes():string;


    /**
     * Create note
     *
     * @param $dataRequest
     * @return string response with operation status
     */
    public function CreateNote($dataRequest):string;


    /**
     * Put note
     *
     * @param $dataRequest
     * @param $noteId
     * @return string response with operation status
     */
    public function PutNote($dataRequest, $noteId):string;


    /**
    * Delete note
     *
     * @param $noteId
     * @return string response with operation status
    */
    public function DeleteNote($noteId):string;
}