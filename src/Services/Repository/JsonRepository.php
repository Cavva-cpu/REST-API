<?php
namespace Services\RepositoryMethod;
use Services\RepositoryInterface\RepositoryInterface;
class JsonRepository implements RepositoryInterface
{
    const file = '\REST API\Repository.json';
    public function Get()
    {
        if (file_exists(file))
        {
            $json_string = file_get_contents(file);
        }

        else
        {
            $json_string = "File no have data";
        }
        return $json_string;
    }

    public function Create($data_request)
    {
        if (file_exists(file)) {
            $json_string = file_get_contents(file);
            $data = json_decode($json_string, true);
        }

        $data[] = $new_item = [
            'note' => $data_request['note'],
        ];
        foreach ($data as $index => $note) {
            $data_with_id[] = array(
                'id' => $index + 1,
                'note' => $note['note']
            );
        }

        $updated_json = json_encode($data_with_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $updated_json;
    }

    public function Put($data_request, $note_id)
    {
        if (file_exists(file)) {
            $json_srting = file_get_contents(file);
            $data = json_decode($json_srting, true);
        }

        $data[$note_id - 1]['note'] = $data_request['note'];

        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $updated_json;
    }

    public function Delete($note_id)
    {
        if (file_exists(file)) {
            $json_srting = file_get_contents(file);
            $data = json_decode($json_srting, true);
        }

        unset($data[$note_id - 1]);
        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $updated_json;
    }

}