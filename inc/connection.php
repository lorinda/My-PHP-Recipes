<?php
$user = 'chef';
$pd = 'c0ok!ngM3als';
$dbase = 'my_apron';

try{
    $db = new PDO('mysql:host=localhost;dbname='.$dbase, $user, $pd);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    echo 'Unable to Connect';
    echo $e->getMessage();
    exit;
    
}

?>