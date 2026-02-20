<?php
namespace Services\NoteRepository;
class JsonNoteRepository implements NoteRepositoryInterface
{
    const string FILE_PATH = 'Repository.json';
    public function getAllNotes():array|string
    {
        if (file_exists(self::FILE_PATH))
        {
            $jsonString = file_get_contents(self::FILE_PATH);
        }
        else{
            return "Repository.json file doesn't exist";
        }

        return json_decode($jsonString);
    }

    public function createNote(string $note):array|string
    {
        if (file_exists(self::FILE_PATH)) {
            $json_string = file_get_contents(self::FILE_PATH);
            $data = json_decode($json_string, true);
        }
        else{
            return "Repository.json file doesn't exist";
        }


        $data[] = $new_item = [
            'note' => $note,
        ];
        if(isset($data)){
            foreach ($data as $index => $note) {
                $data_with_id[] = array(
                    'id' => $index + 1,
                    'note' => $note['note'],
                );
            }
        }


        $data_array = end($data_with_id);
        $updated_json = json_encode($data_with_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(self::FILE_PATH , $updated_json);
        return $data_array;

    }

    public function putNote(int $id , string $note):array|string
    {
        if (file_exists(self::FILE_PATH)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }
        else{
            return "Repository.json file doesn't exist";
        }
        $noteid = $id;
        $noteText = $note;
        $data[$noteid - 1]['note'] = $noteText;
        $data_array = $data[$noteid - 1];
        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(self::FILE_PATH, $updated_json);
        return $data_array;
    }

    public function deleteNote(int $noteId):bool|string
    {
        if (file_exists(self::FILE_PATH)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }
        else{
            return "Repository.json file doesn't exist";
        }
        $noteid = $noteId;
        unset($data[$noteid - 1]);

        if(isset($data)){
            foreach ($data as $index => $note) {
                $data_with_id[] = array(
                    'id' => $index + 1,
                    'note' => $note['note'],
                );
            }
        }
        $code_done = true;
        $updated_json = json_encode($data_with_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(self::FILE_PATH, $updated_json);
        return $code_done;

    }

}

