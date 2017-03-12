<?php
require '/private/database-access.php';

try{
    $db = new PDO('mysql:host='.$host.';dbname='.$dbase, $user, $pd);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    echo 'Unable to Connect';
    echo $e->getMessage();
    exit;
    
}

?>