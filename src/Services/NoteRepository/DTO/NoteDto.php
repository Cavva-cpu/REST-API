<?php
namespace Dto\NoteDto;
class NoteDto
{
    public ?string $note;
    public ?int $id = null;
    public function __construct($note,$id)
    {
        $this->note = $note;
        $this->id = $id;
    }

}