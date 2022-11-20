<?php
    if (empty($_POST['uname']) || empty($_POST['pass'])) {
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Complete the form.'
        );

        echo json_encode($result);
        exit();
    }

    $uname = string_escape($_POST['uname']);
    $pwd = string_escape($_POST['pass']);
    $pass = md5($acak.md5($pwd));

    //get the data
    $q="
        SELECT 
            id
        
        FROM 
            akun

        WHERE
            hapus = '0'
        AND
            uname = '$uname'
        AND
            pass = '$pass'
        
        LIMIT
            1
    ";

    $e = mysqli_query($conn, $q);
    $c = mysqli_num_rows($e);

    if($c == 0){
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Data not found.'
        );

        echo json_encode($result);
        exit();
    }

    $r = mysqli_fetch_assoc($e);

    $sub = array(
        'id' => $r['id']
    );

    $result['data'][] = $sub;

    //return the result
    echo json_encode($result);
    exit();
?>