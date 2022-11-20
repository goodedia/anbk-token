<?php
    //get the data
    $q="
        SELECT 
            id, 
            token
        
        FROM 
            token

        WHERE
            hapus = '0'
        AND
            aktif = '1'
        
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
        'id' => $r['id'],
        'token' => $r['token']
    );

    $result['data'][] = $sub;

    //return the result
    echo json_encode($result);
    exit();
?>