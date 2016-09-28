<?php
header('Content-type: text/html; charset=utf-8');
session_start();
if(!$_SESSION['user']){
    header ("Location: login_form.php");//redirect на авторизацию
    die();
}
    else
    {
          $title = ucfirst($_SESSION['user']);
    } 
require_once 'db_functions.php';

$record = select_all_record();


?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="admin" />
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"/>
     <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" />
    <link rel="stylesheet" href="styles/reset.css" />
    <link rel="stylesheet" href="styles/style.css" /> 
    <script src="scripts/jquery.js"></script>
    <script src="scripts/jquery.cookie.js"></script>
    <script src="scripts/database.js"></script>
	<title>База данных <?php echo $title;?></title>

</head>

<body>
  <div id="header">
        <div id="logo"><a href="index.php"><?php echo $title;?></a></div>
        <div id="menu">
            <span><a  class="icon" href="index.php"><img src="images/main.png" /> Главная</a></span>
            <?php if($record):?>
            <span><a  class="icon" target="_blank" href="print.php"><img src="images/print_head.png" /> Печать</a></span>
            <?php endif;?>
            <span><a  class="icon" href="logout.php"><img src="images/exit.png" /> Выход</a></span>
        </div>
    </div>
  
<div id="main_block">
<?php
	require_once 'view_list.php'; //список ценников из базы данных
?>
<div id="clear_form_div" ><button id="clear_form">Сбросить все</button></div>
<br /><span class="form_info_2">
    1.Укажите цену, страну производителя и количество необходимых ценников<br />
    2.Для добавления ценников в очередь печати нажмите <img src="images/print.png"/><br />
    3.Для очистки очереди печати нажмите кнопку 'Сбросить все'<br />
    4.Для удаления из Базы данных нажмите <img src="images/trash.png"/><br />
    5.Для печати перейдите в раздел <a href="print.php">'Печать'</a>
</span>
</div>

<div id="footer">
        <p><a href="https://vk.com/id246086595">&copy; Buchastiy Sergey 2016</a></p>
    </div>
</body>
</html>
