<?php
	session_start();
    require_once 'db_functions.php';
    
    $tag_id = $_POST['tag_id'];
    
    if(delete_record($tag_id)){
        echo true;
    }else{
        echo false;
    }
?>