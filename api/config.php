<?php
	//set header
    header("Content-Type: application/json; charset=UTF-8");

	//check if token posted
	if(empty($_POST['token'])){
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'API token not present.'
        );

        echo json_encode($result);
        exit();
    }

	//check if action posted
	if(empty($_POST['act'])){
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Action not present.'
        );

        echo json_encode($result);
        exit();
    }

	//lock server timezone to jakarta
	date_default_timezone_set('Asia/Jakarta');
	

	//operating system for local dev and testing -> win, mac, linux, android
	//should be win -> xampp, mac + linux -> pure, android -> kickwebserver
	$system_os = 'win';
	
    //database connection
    $system_for = 'local'; //local, vps, or hosting

    //database connection setting
    $db_host = 'localhost';
    $db_name = 'anbk_token'; //local & vps db name should same, hosting used to be different
	$db_user = 'root';
    $db_pass = 'Password123#@!';

    //domain list for online
	$domain = array(
		'anbk-token.io'
	);

	//root folder detection
	$base_location = array(
		'win' => 'C:/xampp/htdocs/',
		'linux' => '/var/www/html/',
		'mac' => '/Users/sen/Websites/',
		'android' => 'storage/emulated/0/htdocs/'
	);

	if(!array_key_exists($system_os, $base_location)){
		$result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Invalid OS Setting.'
        );

        echo json_encode($result);
        exit();
	}

	//baseFolder setting
    if($system_for == 'local'){
		//mac os should using ip instead for db connection
		if($system_os == 'mac'){
			$db_host = '127.0.0.1';
		}
    }
    else if($system_for == 'hosting'){
    	//hosting config -> db user, db name, db pass should same or as provide by hosting data
        $db_user = $db_name;
        $db_pass = $db_name;
    }

	//the database connection
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    //if connection failed
    if(!$conn){
		$result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Database connection failed.'
        );

        echo json_encode($result);
        exit();
    }


	
	











	//app code
	$appCode = 'yxf-hQcv-HzDro-Vyox30e5-PRAHl';

	$q = "
        SELECT
            id,
            programmer,
            programmer_email,
            dev,
            dev_web,
            version,
            randomizer,
            maintenance,
            maintenance_info,
            debug,

            title,
			description,
			deploy_year
			
        FROM
            app a
        
        WHERE
            id = '$appCode'

		LIMIT
			1
	";

	$e = mysqli_query($conn, $q);
	$c = mysqli_num_rows($e);

	if($c == 0){
		$result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Illegal Access!!'
        );

        echo json_encode($result);
		exit();
	}
	
	$r = mysqli_fetch_assoc($e);

	//maintenance setting based on database
    $maintenance = $r['maintenance'];
	$maintenance_info = $r['maintenance_info'];

	if($maintenance == 1){
		$result = array(
            'code' => '2',
            'status' => 'warning',
            'message' => 'SYSTEM MAINTENANCE<br><br>'.$maintenance_info
        );

        echo json_encode($result);
		exit();
	}

	//debug setting based on database
	$debug = $r['debug'];
	if($debug == 1){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}
	else {
		error_reporting(0);
	}

	//info version and maker
	$author = $r['programmer'].' - '.$r['programmer_email'];
	$dev = $r['dev'];
	$devWeb = $r['dev_web'];
	$version = $r['version'];

	//custm hash for randomizer
	$acak = $r['randomizer'];
	

	//base info setting of website
	$title = $r['title'];
	$description = $r['description'];
	$deploy_year = $r['deploy_year'];
	
	//today date & time
	$today_date = date('Y-m-d');
	$today_time = date('H:i:s');
	$today_name = date("l");





	//filter every input from user
	function string_escape($string){
		$pure = htmlspecialchars(trim($string));
		global $conn;

		$processed = mysqli_real_escape_string($conn, $pure);
		return $processed;
	}

	
	//generate unique long code
	function uuid_create($char_max = 64) {
		$min_t = 1;
		$max_t = 7;
		$min_l = 2;
		$max_l = 8;
		$strSources = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		$t = rand($min_t, $max_t);
		
		$guidText = '';
		
		for ($i=0; $i <= $t; $i++) {
			$l = rand($min_l, $max_l);
			$guidText .= substr(str_shuffle($strSources), 0, $l);

			if($i < $t) {
				$guidText .= "-";
			}
		}

		$char_l = strlen($guidText);
		if($char_l > $char_max){
			$guidText = substr($guidText, 0, $char_max);
		}

		return $guidText;
	}

	//days reference
	$arDays = array(
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu'
    );

	//months reference
	$arMonth = array(
		'',
		'Januari', 
		'Februari', 
		'Maret', 
		'April', 
		'Mei', 
		'Juni', 
		'Juli', 
		'Agustus', 
		'September', 
		'Oktober', 
		'November', 
		'Desember'
	);

	//number reference
    $arNumber = array(
		'', 
		'one', 
		'two', 
		'three', 
		'four', 
		'five', 
		'six', 
		'seven', 
		'eight', 
		'nine', 
		'ten',
		'eleven',
		'twelve',
		'thirteen',
		'fourteen',
		'fiveteen',
		'sixteen'
    );


	
	//receive the api token
	$token = string_escape($_POST['token']);

	//receive the action
	$act = string_escape($_POST['act']);
	
	//referene for action (available action)
	$action_ref = array(
		'login' => array(
			'url' => 'login/index.php',
			'desc' => 'Login ke sistem',
			'param' => array(
				'token' => 'API token unik untuk berkomunikasi dengan sistem',
				'act' => 'Aksi yang ingin dilakukan: login',
				'uname' => 'Username pengguna',
				'pass' => 'Password pengguna'
			)
		),

		'doc-get-all' => array(
			'url' => 'doc/get-all.php',
			'desc' => 'Mendapatkan semua data info dokumentasi',
			'param' => array(
				'token' => 'API token unik untuk berkomunikasi dengan sistem',
				'act' => 'Aksi yang ingin dilakukan: doc-get-all'
			)
		),

		'token-get' => array(
			'url' => 'token/get.php',
			'desc' => 'Mendapatkan token anbk',
			'param' => array(
				'token' => 'API token unik untuk berkomunikasi dengan sistem',
				'act' => 'Aksi yang ingin dilakukan: asset-get-all'
			)
		),
		'token-set' => array(
			'url' => 'token/set.php',
			'desc' => 'Menyimpan token baru',
			'param' => array(
				'token' => 'API token unik untuk berkomunikasi dengan sistem',
				'act' => 'Aksi yang ingin dilakukan: token-set',
				'data_token' => 'Token ANBK yang akan disimpan'
			)
		),

		'pass-set' => array(
			'url' => 'pass/set.php',
			'desc' => 'Menyimpan password baru',
			'param' => array(
				'token' => 'API token unik untuk berkomunikasi dengan sistem',
				'act' => 'Aksi yang ingin dilakukan: passs-set',
				'pass' => 'Password yang akan disimpan'
			)
		)
	);

	//filter if the action valid
	if(!array_key_exists($act, $action_ref)){
		$result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'Action invalid.'
        );

        echo json_encode($result);
        exit();
	}

	//get the file url for action load
	$act_load = $action_ref[$act]['url'];
    
    //check the token for validity
    $q = "
        SELECT 
            id

        FROM 
            api_access

        WHERE
            token = '$token'
        AND
            hapus = '0'

        LIMIT
            1
    ";

    $e = mysqli_query($conn, $q);
    $c = mysqli_num_rows($e);

    if($c == 0){
        $result = array(
            'code' => '0',
            'status' => 'failed',
            'message' => 'API token invalid.'
        );

        echo json_encode($result);
        exit();
    }



	//the base result
    $result = array(
        'code' => '1',
        'status' => 'success',
        'message' => '',
        'data' => array()
    );

?>