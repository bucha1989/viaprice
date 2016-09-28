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
    
require_once 'lib/simple_html_dom.php';
require_once 'functions.php';
require_once 'db_functions.php';

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="admin" />
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="styles/reset.css"/>
    <link rel="stylesheet" href="styles/style.css"/>
    <link rel="stylesheet" href="styles/example_tag.css" />
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" />
    <script src="scripts/jquery.js"></script>
    <script src="scripts/jquery.json.min.js"></script>
    <script src="scripts/functions.js"></script>
    <script src="scripts/main.js"></script>
    
</head>
<body>
    
    <div id="header">
        <div id="logo"><a href="index.php"><?php echo $title;?></a></div>
        <div id="menu">
            <span><a  class="icon" href="db_list.php"><img src="images/db.png"  /> База данных</a></span>
<!--
            <span><a  class="icon" target="_blank" href="print.php"><img src="images/print_head.png" /> Печать</a></span>
-->
            <span><a  class="icon" href="logout.php"><img src="images/exit.png" /> Выход</a></span>
        </div>
    </div>
    
    <div id="main_string">
        <form id="form_parse">
            <input type="text" id="user_string" maxlength="200" placeholder="Вставте строку. Пример: 195/55R16 Hankook W419 91T XL п/ш (шт.)" />
            <button id="submit_parse">Разбор</button>
        </form>
    </div>
    <p id="test_string">Тестовая строка: 215/75R16C Hankook RW09 116/114R п/ш (шт.)</p>
    
<!-- Блок для сообщений -->
    <div id="notice">
        <p class="notice"></p>
    </div> 
<div id="description">
        <div id="loader" >
            <img src="images/loader.gif" />
        </div>
        <div id="form_to_db">
        <!--
<p>Форма заполняется автоматически или вручную</p>
-->
<form action="add_to_db.php" method="post">
            <fieldset><legend>Обязательные поля</legend>
            <span class="required"></span><input  type="text" placeholder="Ширина" maxlength="3" name="width" />
            <span class="required"></span><input type="text" placeholder="Высота"  maxlength="2" name="height" />
            <span class="required"></span><input type="text" placeholder="Диаметр" maxlength="2" name="diameter" />
            <br />
            <span class="required"></span><input  maxlength="10" placeholder="Название" class="wide_input"  type="text" name="name" />
            <span class="required"></span><input  maxlength="20" placeholder="Модель" class="wide_input" type="text" name="model" />
            <br />
            <span class="required"></span><input type="text" placeholder="Индекс нагрузки"  maxlength="3" name="load_index" />
            
            <span class="required"></span><input placeholder="Индекс скорости" type="text" maxlength="3" name="speed_index" />
            <span class="required"></span><input placeholder="Страна" type="text" maxlength="15" name="country" />
            <br />
            </fieldset>
            <label>Сargo <input type="checkbox" value="1" name="cargo" /></label>
            <label>XL <input type="checkbox" value="1" name="xl" /></label>
            <label>П/Ш <input type="checkbox" value="1" name="for_spike" /></label>
            <label>ШИП <input type="checkbox" value="1" name="spike" /></label>
            <label>RUN FLAT <input type="checkbox" value="1" name="run_flat" /></label>
            <label>SUV <input type="checkbox" value="1" name="suv" /></label>
            <input type="text" placeholder="Индекс нагрузки 2" maxlength="3" name="load_index_2" />
            
            <br />
            <textarea  placeholder="Описание" name="description"></textarea>
            <br /><span class="form_info"><b>0</b> симв. макcимум 350 симв.</span><br />
            <div id="notice_form">
                    <p class="notice"></p>
                </div>
<div class="main">
            <div class="price_tag">
        <div id="head">
            <div id="for_button"><img src="images/point.gif" /></div>
            <div id="brand"><img src="images/vianor_logo.png" /></div>
            
        </div>
        <div id="size"></div>
        <div id="name"></div>
        <div id="decr_brief">
            <div id="labels">
            </div>
            <div id="brief">
                <span id="brief_speed_index" class="left"></span>
                <span id="brief_speed_value" class="right">xxx км/ч</span><br />
                <span id="brief_load_index" class="left"></span>
                <span id="brief_load_value" class="right">xxx кг</span><br />
                <span id="country_index" class="left">Страна производитель:</span>
                <span id="country_value" class="right"></span><br />
            </div>
        </div>
        <div id="descr"></div>
        <div id="price">
            <p><span class="small">Цена: </span>
            <span class="big">XXXX</span>
            <span class="small"> грн</span></p>
        </div>
        <div id="private"><?php echo select_private();?></div>
    </div>
</div>
    <br /><span class="form_info_2">Внимательно проверьте форму перед добавлением в базу данных!!!</span><br />
    <span class="form_info_2">После добавления всех необходимых ценников перейдите в раздел <a href="db_list.php">'База данных'</a></span><br />
    <button id="submit_form">Добавить</button>
    <button id="clear_form">Очистить</button>
</form>
</div>
</div>
 <div id="notice_form">
    <p class="notice"></p>
 </div>               
<div id="big_block"></div>                
<div id="footer">
    <p><a href="https://vk.com/id246086595">&copy; Buchastiy Sergey 2016</a></p>
</div>                

</body>
</html>