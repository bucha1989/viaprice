<?php

require_once 'db_functions.php';

if(isset($_POST['submit'])){ //проверка нажатия кнопки

$login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING); //удаление тегов
$login = strtolower(trim($login)); //в нижний регистр + обрезка пробелов
$pass = filter_input(INPUT_POST,'pass',FILTER_SANITIZE_STRING); //удаление тегов
$pass = strtolower(trim($pass));//в нижний регистр + обрезка пробелов
$private =  filter_input(INPUT_POST,'private',FILTER_SANITIZE_STRING); //удаление тегов
$private = trim($private);

$pdo = db_connect();    
    //--------------------------------------Дополнительная проверка корректности данных ... -------------------------------------------//
     if(!preg_match("/^[a-zA-Z0-9]+$/",$login))
    {
        header ("Location: registration_form.php?msg=Логин должен содержать только латинские буквы и цифры");
    }
    
     if(strlen($_POST['login']) < 3)
    {
        header ("Location: registration_form.php?msg=Логин должен содержать не менее 3-х символов");
    }
    
$pass = password_hash($pass,PASSWORD_DEFAULT);    
    
$stmt = $pdo->prepare("INSERT INTO users VALUES('null',:login,:pass,:private)");
$stmt->execute(array('login'=>$login,'pass'=>$pass,'private'=>$private));

if($pdo->lastInsertId()){
 //--------------------------------------Создание таблиц для пользователя ... -------------------------------------------//   
$stmt = $pdo->prepare("
    CREATE TABLE IF NOT EXISTS $login (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '0',
  `model` varchar(50) DEFAULT '0',
  `width` int(3) DEFAULT '0',
  `height` int(3) DEFAULT '0',
  `diameter` int(2) DEFAULT '0',
  `load_index` int(3) DEFAULT '0',
  `load_index_2` int(3) DEFAULT '0',
  `speed_index` varchar(5) DEFAULT '0',
  `cargo` tinyint(1) DEFAULT '0',
  `spike` tinyint(1) DEFAULT '0',
  `for_spike` tinyint(1) DEFAULT '0',
  `xl` tinyint(1) DEFAULT '0',
  `suv` tinyint(1) DEFAULT '0',
  `run_flat` tinyint(1) DEFAULT '0',
  `country` varchar(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");

$stmt->execute();


$login_descr = $login.'_descr';   
$stmt = $pdo->prepare("
   CREATE TABLE IF NOT EXISTS $login_descr (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '0',
  `model` varchar(50) DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

$stmt->execute();
    
            session_start();                //автоматический вход
            $_SESSION['user'] = $login;
            header ("Location: index.php");
            
    
}else{
    header ("Location: registration_form.php?msg=Ошибка регистрации");
}  
    
}else{
    header ("Location: registration_form.php?msg=Форма отправлена некорректно");
}

?>