<?php
namespace Services\Repository;
use Services\RepositoryInterface\RepositoryInterface;
class JsonRepository implements RepositoryInterface
{
    const file = '\REST API\Repository.json' ;
    public function GetAllNotes():string
    {
        if (file_exists(file))
        {
            $jsonString = file_get_contents(file);
        }

        return $jsonString;
    }

    public function CreateNote($dataRequest):string
    {
        if (file_exists(file)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }

        $data[] = $new_item = [
            'note' => $dataRequest['note'],
        ];
        foreach ($data as $index => $note) {
            $data_with_id[] = array(
                'id' => $index + 1,
                'note' => $note['note']
            );
        }

        $updated_json = json_encode($data_with_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(file, $updated_json);
        return "Записка была успешно добавленна!";
    }

    public function PutNote($dataRequest, $noteId):string
    {
        if (file_exists(file)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }

        $data[$noteId - 1]['note'] = $dataRequest['note'];

        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(file, $updated_json);
        return "Записка была успешно обновлена!";
    }

    public function DeleteNote($noteId):string
    {
        if (file_exists(file)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }

        unset($data[$noteId - 1]);
        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(file, $updated_json);
        return "Записка была успешно удалена!";

    }

}