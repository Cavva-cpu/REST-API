<?php
namespace Services\NoteRepository;
class JsonNoteRepository implements NoteRepositoryInterface
{
    private const string FILE_PATH = 'Repository.json';
    public function getAllNotes():array
    {

        if (file_exists(self::FILE_PATH))
        {
            $jsonString = file_get_contents(self::FILE_PATH);
            $noteArray = json_decode($jsonString, true);
            $return = array_map(function (array $notes) {
                return "note {$notes['id']}: {$notes['note']}";
            } , $noteArray);
            return $return;
        }
        else
        {
            throw new \Exception("File Repositroy.json doesn't exist");
        }
    }

    public function createNote(string $note):array
    {
        if (file_exists(self::FILE_PATH)) {
            $jsonString = file_get_contents(self::FILE_PATH);
            $data = json_decode($jsonString, true);
        }
        else{
            throw new \Exception("File Repositroy.json doesn't exist");
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

    public function putNote(int $id , string $note):array
    {
        if (file_exists(self::FILE_PATH)) {
            $jsonString = file_get_contents(self::FILE_PATH);
            $data = json_decode($jsonString, true);
        }
        else{
            throw new \Exception("File Repositroy.json doesn't exist");
        }
        $data[$id - 1]['note'] = $note;
        $data_array = $data[$id - 1];
        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(self::FILE_PATH, $updated_json);
        return $data_array;
    }

    public function deleteNote(int $noteId):bool
    {   try {
        if (file_exists(self::FILE_PATH)) {
            $jsonString = file_get_contents(self::FILE_PATH);
            $data = json_decode($jsonString, true);
        } else {
            throw new \Exception("File Repositroy.json doesn't exist");
        }
        unset($data[$noteId - 1]);

        if (isset($data)) {
            foreach ($data as $index => $note) {
                $dataWithId[] = array(
                    'id' => $index + 1,
                    'note' => $note['note'],
                );
            }
        }

        $updatedJson = json_encode($dataWithId, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(self::FILE_PATH, $updatedJson);
        return true;

    }catch (\Exception $exception){
        echo $exception->getMessage();
        return false;
    }
    }

}

