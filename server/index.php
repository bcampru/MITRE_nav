<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: *');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $entityBody = file_get_contents('php://input');
        $json = json_decode($entityBody);
        if($json->ruid == ""){
            $name = "ioho";
            $json->ruid = "ioho";
            $entityBody = json_encode($json);
        }
        $file=fopen("./data/" . $json->ruid, "w");
        fwrite($file, $entityBody);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "OPTIONS"){
        $scanned_directory = array_diff(scandir('./data', 1), array('..', '.'));
        print('[{"name":"io", "ruid":"ioho"}]');
    }
    
    else{
        print(file_get_contents("./data/" . $_GET['ruid']));
    }
?>