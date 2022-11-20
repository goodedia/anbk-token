<?php
    //validation
    if (empty($_POST['data_token'])) {
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Complete the form.'
        );

        echo json_encode($result);
        exit();
    }

    //receive the data
    $token = string_escape($_POST['data_token']);

    //delete old data
    $q = "
        DELETE FROM 
            token
    ";

    $e = mysqli_query($conn, $q);
    if(!$e){
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Unable to delete old data.'
        );

        echo json_encode($result);
        exit();
    }

    
    //create new data id
    $id = uuid_create();

    //put the data
    $q="
        INSERT INTO 
            token
                (
                    id, 
                    token, 
                    aktif
                ) 
        VALUES
                (
                    '$id', 
                    '$token', 
                    '1'
                ) 
    ";

    $e = mysqli_query($conn, $q);
    if(!$e){
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Query failed.'
        );

        echo json_encode($result);
        exit();
    }

    //return the result
    echo json_encode($result);
    exit();
?>