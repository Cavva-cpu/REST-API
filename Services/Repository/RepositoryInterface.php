<?php

interface RepositoryInterface
{
    public function Get();
    public function Create($data_request);
    public function Put($data_request, $note_id);
    public function Delete($note_id);
}