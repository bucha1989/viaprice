<?php

require_once 'db_functions.php';

//проверка при регистрации существования пользователя и валидация по регулярке

$user = filter_input(INPUT_POST,'user',FILTER_SANITIZE_STRING); //удаление тегов

preg_match('/[[:punct:]а-яА-Я]+/',$user,$match);

if(is_user($user)||isset($match[0])||is_numeric(substr($user,0,1))){
    
    echo true;
}else{
    echo false;
}

?>