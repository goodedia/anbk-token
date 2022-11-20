<?php

    $appSection = 'api';
    $fromHome = '';

    require_once 'config.php';

    //reply if file not found
    if(!file_exists($act_load)){
        $result = array(
            'code' => '2',
            'status' => 'failed',
            'message' => 'API target file not found',
            'data' => array()
        );
        
        echo json_encode($result);
        exit();
    }

    require_once $act_load;

?>