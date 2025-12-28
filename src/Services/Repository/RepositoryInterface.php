<?php
namespace Services\RepositoryInterface;
interface RepositoryInterface
{
    public function Get();
    // This method simply gives you the contents of the Repository.json file.
    public function Create($data_request);
    // Only the note title should be sent to this method.
    public function Put($data_request, $note_id);
    // This method should be sent the object ID from Repository.json and the text with which we want to replace the text of this object.
    public function Delete($note_id);
    // This method should be passed the ID of the object from Repository.json that you want to delete.
}