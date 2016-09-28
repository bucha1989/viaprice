<?php

require_once 'db_functions.php';

if(isset($_POST['submit'])){ //проверка нажатия кнопки

$login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING); //удаление тегов
$login = strtolower(trim($login)); //в нижний регистр + обрезка пробелов
$pass = filter_input(INPUT_POST,'pass',FILTER_SANITIZE_STRING); //удаление тегов
$pass = strtolower(trim($pass));//в нижний регистр + обрезка пробелов

$pdo = db_connect();    


$stmt = $pdo->prepare("SELECT password FROM users WHERE user=:user");
$stmt->execute(array('user'=>$login));  
    
    if($stmt->rowCount()>0){
        $hash = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['password'];
        
        $access = password_verify($pass,$hash);
        if($access){
            session_start();
            $_SESSION['user'] = $login;
            header ("Location: index.php");
        }else{
            header ("Location: login_form.php?msg=Неверный логин/пароль");
        }
    }
    else
    {
        header ("Location: login_form.php?msg=Неверный логин/пароль");
    }    
    
}else{
    header ("Location: login_form.php?msg=Форма отправлена некорректно");
}

?>