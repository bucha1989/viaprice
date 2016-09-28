<?php
	header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Регистрация</title>
    <link rel="stylesheet" href="styles/reset.css"/>
	<link rel="stylesheet" href="styles/for_login.css" media="screen" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"/>
    <script src="scripts/jquery.js"></script>
    <script src="scripts/registration.js"></script>
</head>
<body>

    <div id="login">
        <form action="registration.php" method="post">
            <fieldset class="clearfix">
                <p class="msg"><?php if(isset($_GET['msg'])) echo $_GET['msg'];?></p>
                <p><span class="fontawesome-user"></span><input minlength='3' pattern="[\w\d]+" type="text" placeholder="Логин" name="login" required='' /></p>
                <p id="pass_pgf"><span class="fontawesome-lock"></span><input minlength='6' pattern="[\w\d]+" type="password"  placeholder="Пароль" name="pass"  required='' /></p>
                <p class="tip">Эти данные будут указаны в нижней части ценника</p><p><span class="fontawesome-cogs"></span><input type="text" placeholder="Данные о ЧП" name="private"  required='' /></p>
                <p><input type="submit" name="submit" value="РЕГИСТРАЦИЯ" /></p>
                <p class="tip">
                - Логин не должен совпадать уже существующим<br />
                - Логин должен содержать не менее 3-х символов, а пароль не менее 6-ти<br />
                - Логин и пароль не должны совпадать<br />
                - Логин и пароль должны содержать только латинские буквы и цифры</p>
            </fieldset>
        </form>
        <p>Уже есть аккаунт? &nbsp;&nbsp;<a href="login_form.php">Войти</a><span class="fontawesome-arrow-right"></span></p>
    </div>
    
</body>
</html>