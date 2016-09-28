<?php

$pass = filter_input(INPUT_POST,'pass',FILTER_SANITIZE_STRING); //удаление тегов

preg_match('/[[:punct:]а-яА-Я]+/',$pass,$match);

if(isset($match[0])){
    
    echo true;
}else{
    echo false;
}

?>