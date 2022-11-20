<?php
    //validation
    if (empty($_POST['user_id']) || empty($_POST['p1'])) {
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Complete the form.'
        );

        echo json_encode($result);
        exit();
    }

    //receive the data
    $id = string_escape($_POST['user_id']);
    $pwd = string_escape($_POST['p1']);
    $pass = md5($acak.md5($pwd));

    //update the password
    $q = "
        UPDATE
            akun
        
        SET
            pass = '$pass'
        
        WHERE
            id = '$id'
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