<?php
	header('Content-type: text/html; charset=utf-8');
    session_start();
    if(isset($_SESSION['user'])) header ("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Вход</title>
    <link rel="stylesheet" href="styles/reset.css"/>
	<link rel="stylesheet" href="styles/for_login.css" media="screen" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"/>
    <script src="scripts/jquery.js"></script>
 <script>
$(document).ready(function(){
        
    $('input[name=login]').keyup(function(){//проверка допустимости ПОЛЬЗОВАТЕЛЯ
            
       user = $(this).val()
       
       if(user.length<3){
            $('#pass_pgf').slideUp(500)
       }else{
            $('#pass_pgf').slideDown(500)
       }
             
    })
    
})//конец скрипта
</script>

</head>
<body>
    <div id="login">
        <form action="login.php" method="post">
            <fieldset class="clearfix">
                <p class="msg"><?php if(isset($_GET['msg'])) echo $_GET['msg'];?></p>
                <p><span class="fontawesome-user"></span><input minlength='3' pattern="[\w\d]+" type="text" placeholder="Логин"  name="login" required='' /></p>
                <p id="pass_pgf"><span class="fontawesome-lock"></span><input minlength='6' pattern="[\w\d]+" type="password"  placeholder="Пароль" name="pass"  required='' /></p>
                <p><input type="submit" name="submit" value="ВХОД" /></p>
                <p class="tip">
                - Логин должен содержать не менее 3-х символов<br />
                - Логин и пароль не должны совпадать</p>
            </fieldset>
        </form>
        <p>Нет аккаунта? &nbsp;&nbsp;<a href="registration_form.php">Регистрация</a><span class="fontawesome-arrow-right"></span></p>
    </div>
</body>
</html>