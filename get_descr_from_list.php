<?php
require_once 'lib/simple_html_dom.php';
require_once 'functions.php';

$url = $_POST['url'];

$data = curl($url);

        $html = str_get_html($data); 
        if(@$html->innertext!='' and count($html->find('span#text_preview'))) {
        $description = $html->find('span#text_preview')[0];
        $description = filter_var($description,FILTER_SANITIZE_STRING); //очистка описания от тегов
        }
        
        if(isset($description) && $description != 'Посмотреть отзывы о других моделях шин'){
        
            echo $description; //если описание найдено возвращаем его
        
        $html->clear(); //освобождение ресурсов
        unset($html); //удаление переменной
        }else{
             echo false;
        }
?>