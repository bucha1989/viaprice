<?php

require_once 'db_functions.php';
session_start();


$final_array = json_decode($_POST['select_form_data'],true);

if(is_description($final_array)==false){  //проверяет есть ли описание
    insert_description($final_array);
}else{  
    update_description($final_array,is_description($final_array));
}

if(is_record($final_array)==false){  //проверяет есть ли запись
    if(insert_record($final_array)){
        echo "Новая запись {$final_array['name']} {$final_array['model']} успешно добавлена";
    }else{
        echo "Невозможно добавить запись";
    }        //если нет добавляет новую
}else{  
    update_record($final_array,is_record($final_array));
        echo "Запись {$final_array['name']} {$final_array['model']} успешно обновлена";
}
 



?>