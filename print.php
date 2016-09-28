<?php

header('Content-type: text/html; charset=utf-8');
session_start();
if(!$_SESSION['user']){
    header ("Location: login_form.php");//redirect на авторизацию
    die();
}
require_once 'db_functions.php';
$pdo = db_connect();
$user = $_SESSION['user'];

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="admin" />
    <link rel="stylesheet" href="styles/reset.css" />
    <link rel="stylesheet" href="styles/for_print.css" />
    <script src="scripts/jquery.js"></script>
	<title>Печать</title>
    <script>
    $(document).ready(function(){
        
            $('#click_print').click(function(){
                window.print();
            })

    })//конец скрипта
</script>
</head>

<body>

<div id="click_print"></div>
<div class="main">

<?php


foreach($_COOKIE as $id=>$value){
    
    if($id=='PHPSESSID') continue; //пропуск куков сессии
    
    $stmt = $pdo->prepare("SELECT * FROM $user WHERE id=:id");
    $stmt->execute(array('id'=>$id));
    
    extract($stmt->fetchAll(PDO::FETCH_ASSOC)[0]); //превращение в переменные
     
    $value = explode(',',$value);
    list($price,$country,$count)=$value;
    //--------------------------------------получение значений индексов скорости и нагрузки ... -------------------------------------------//
    
    $load_value = get_load($load_index);
    
    $load_value_2 = FALSE; //сброс значения после С-шки
    
    if($load_index_2>0){
        $load_value_2 = get_load($load_index_2);
    }
    
    $speed_value = get_speed($speed_index);
    
    //-------------------------------------- получение описания ... -------------------------------------------//
    
    $description = '';
    $param = array();
    $param['name'] = $name;
    $param['model'] = $model;
    
    $id = is_description($param);
    if($id){
       $description =  select_description($id);
    }
    
for($i=0;$i<$count;$i++){?> <!-- FOR start Вывод ценника --> 
    
    <div class="price_tag">
        <div id="head">
            <div id="for_button"><img src="images/point.gif" /></div>
            <div id="brand"><img src="images/vianor_logo.png" /></div>
            
        </div>
        <div id="size"><?php 
            echo "$width/$height R$diameter";
                if($cargo!=0) echo "C ";
            echo " $load_index";
                if($load_index_2>0 && $load_index_2!=false) echo "/$load_index_2";
            echo $speed_index;
        ?></div>
        <div id="name"><?php echo $name." ".$model; ?></div>
        <div id="decr_brief">
        
      
            <div style="width:<?php 
            if($suv == 0 && $xl == 0 && $cargo == 0 && $run_flat == 0 && $for_spike == 0 && $spike == 0) echo "5px";
            ?>;" id="labels"><?php
	       if($suv>0)echo '<div class="item"><img src="images/suv.png" /></div>';
           if($xl>0)echo '<div class="item"><img src="images/xl.png" /></div>';
           if($cargo>0)echo '<div class="item"><img src="images/cargo.png" /></div>';
           if($run_flat>0)echo '<div class="item"><img src="images/run_flat.png" /></div>';
           if($for_spike>0)echo '<div class="item"><img src="images/for_spike.png" /></div>';
           if($spike>0)echo '<div class="item"><img src="images/spike.png" /></div>';
           
            ?></div>
            <div id="brief">
                <span class="left">Индекс скорости <?php echo $speed_index;?>:</span>
                <span class="right"><?php echo $speed_value;?> км/ч</span><br />
                <span class="left">Индекс наргузки <?php 
                echo $load_index;
                if($load_index_2>0) echo "/".$load_index_2;
                ?>:</span>
                <span class="right"><?php 
                echo $load_value;
                if(isset($load_value_2) && $load_value_2!=false) echo "/".$load_value_2;
                ?> кг</span><br />
                <span class="left">Страна производитель:</span>
                <span class="right"><?php echo $country; ?></span><br />
            </div>
        </div>
        <div id="descr"><?php echo $description;?></div>
        <div id="price">
            <p><span class="small">Цена: </span>
            <span class="big"> <?php echo $price;?></span>
            <span class="small"> грн</span></p>
        </div>
        <div id="private"><?php echo select_private();?></div>
    </div>
       
       <!-- FOR end -->
    <?php }
}
?>

</div> <!-- end Main -->    

</body>
</html>