<?php
namespace methods;

class RepositoryJSON{
    public function Post($data_request){
    $file = 'repository/Repository.json';

    if (file_exists($file)) {
        $json_string = file_get_contents($file);
        $data = json_decode($json_string, true);
    }
        
    $new_item = [
        'note' => $data_request['note'],
    ];

    $data[] = $new_item;

    foreach($data as $index => $note){
        $data_with_id[] = array(
            'id' => $index + 1,
            'note' => $note['note']
        );
    }
    
    $updated_json = json_encode($data_with_id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    return $updated_json;
}

    public function Get($data_request){
        $file = 'repository/Repository.json';

        if (file_exists($file)) {
        $json_string = file_get_contents($file);
        }

        return $json_string;
    }

    public function delete ($note_id){
        $file = 'repository/Repository.json';

        if (file_exists($file)){
        $json_srting = file_get_contents($file);
        $data = json_decode($json_srting, true);
        }

        unset($data[$note_id - 1]);

        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $updated_json;
    }

    public function Put ($data_request, $note_id){
        $file = 'repository/Repository.json';

        if (file_exists($file)){
        $json_srting = file_get_contents($file);
        $data = json_decode($json_srting, true);
        }
    
        $data[$note_id - 1]['note'] = $data_request['note'];

        $updated_json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $updated_json;
    }

    }
