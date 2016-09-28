<?php

require_once 'lib/simple_html_dom.php';
require_once 'functions.php';
require_once 'db_functions.php';

$main_string = $_POST['user_string'];

$complete_string = get_input_data_string($main_string);

if($complete_string){
    
   if(parse_string($complete_string)){
    $final_array = parse_string($complete_string);
    session_start();
    
        if($final_array){
            $descr_db = is_description($final_array);
            if($descr_db){
                $description = select_description($descr_db);
            }else{
                $description = curl_parse($final_array);
            }
            
            if(is_string($description)){
                $final_array['description'] = $description;
            }elseif(is_array($description)){
                $description = preg_replace('/_/',' ',$description);
                $final_array['description_array'] = $description;
            }
            
            $final_array['country'] = select_country($final_array);
        }
        
   }else{
     $final_array['error'] = 'Разбор строки невозможен';
   }
    
}else{
    $final_array['error'] = 'Строка пуста';
}

echo json_encode($final_array);
?>