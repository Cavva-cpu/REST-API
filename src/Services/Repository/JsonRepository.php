<?php
namespace Services\Repository;
use Services\RepositoryInterface\RepositoryInterface;
use Dto\repositoryDto;
class JsonRepository implements RepositoryInterface
{
    const string file = '\REST API\Repository.json';
    public function getAllNotes():string
    {
        if (file_exists(file))
        {
            $jsonString = file_get_contents(file);
        }

        return $jsonString;
    }

    public function createNote($repositoryDto):void
    {
        if (file_exists(file)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }



        $data[] = $new_item = [
            'note' => $repositoryDto->note,
        ];
        if(isset($data)){
            foreach ($data as $index => $note) {
                $data_with_id[] = array(
                    'id' => $index + 1,
                    'note' => $note['note'],
                );
            }
        }



        $updated_json = json_encode($data_with_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(file, $updated_json);


    }

    public function putNote($repositoryDto):string
    {
        if (file_exists(file)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }
        $noteid = $repositoryDto->id;
        $note = $repositoryDto->note;
        $data[$noteid - 1]['note'] = $note;

        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(file, $updated_json);
        return "Записка была успешно обновлена!";
    }

    public function deleteNote($repositoryDto):string
    {
        if (file_exists(file)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }
        $noteid = $repositoryDto->id;
        unset($data[$noteid - 1]);

        if(isset($data)){
            foreach ($data as $index => $note) {
                $data_with_id[] = array(
                    'id' => $index + 1,
                    'note' => $note['note'],
                );
            }
        }
        $updated_json = json_encode($data_with_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(file, $updated_json);
        return "Записка была успешно удалена!";

    }

}

