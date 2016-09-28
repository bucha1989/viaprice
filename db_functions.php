<?php

function db_connect(){
    $host_db = 'mysql.hostinger.com.ua';
    $user_db = 'u388582004_bucha';
    $pass_db = 128821;
    $db = 'u388582004_price';
    $charset_db = 'utf8';
    
    $dsn = "mysql:host=$host_db;dbname=$db;charset=$charset_db";
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        //PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $pdo = new PDO($dsn, $user_db, $pass_db, $opt);
    return $pdo;
    //возвращает объект подключения    
}

function insert_record($param){ //Функция добавляет  запись в базу данных
    
     
    $pdo = db_connect();
    $user = $_SESSION['user'];   
    unset($param['description']); //удаление описания из общего массива
    $stmt = $pdo->prepare("INSERT INTO $user VALUES('null',:name,:model,:width,:height,:diameter,
            :load_index,:load_index_2,:speed_index,:cargo,:spike,:for_spike,:xl,:suv,:run_flat,:country)");
    $result = $stmt->execute($param);
    if($stmt){
        return $pdo->lastInsertId();
    }
    //возвращает lastInsertId в случае успешно добавления
}


function is_record($param){ //Функция проверяет сущетвует ли запись в базе данных
    
    $pdo = db_connect();
    $user = $_SESSION['user']; 
    $stmt = $pdo->prepare("SELECT id FROM $user WHERE name=:name AND 
                            model=:model AND width=:width AND height=:height AND diameter=:diameter ");
    $stmt->execute(array('name'=>$param['name'],'model'=>$param['model'],
                        'width'=>$param['width'],'height'=>$param['height'],'diameter'=>$param['diameter']));
    if($stmt->rowCount()>0){
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
    }else{
        return false;
    }
    //возвращает ID записи в случае присутствия
    //или FALSE в случае отсутствия
}

function select_all_record(){
    
    $pdo = db_connect();
    $user = $_SESSION['user']; 
    $stmt = $pdo->prepare("SELECT * FROM $user ORDER BY width,height,diameter,name,model");
    $stmt->execute();
    
    if($stmt->rowCount()>0){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
    //возвращает массив с записями в случае присутствия
    //или FALSE в случае отсутствия
}


function delete_record($id){ //Удаление из БД
     
    $pdo = db_connect();
    $user = $_SESSION['user'];
    $stmt = $pdo->prepare("DELETE FROM $user WHERE id=:id");
    $stmt->execute(array('id'=>$id));
    
    if($stmt->rowCount()>0){
        return true;
    }else{
        return false;
    }
    //возвращает TRUE  в случае присутствия
    //или FALSE в случае отсутствия
}

function update_record($param,$id){ //обновляет 
    
    $pdo = db_connect();
    $user = $_SESSION['user']; 
    unset($param['description']); //удаление описания из общего массива
    $stmt = $pdo->prepare("UPDATE $user SET name=:name,model=:model,width=:width,height=:height,diameter=:diameter,
            load_index=:load_index,load_index_2=:load_index_2,speed_index=:speed_index,country=:country,cargo=:cargo,
            spike=:spike,for_spike=:for_spike,xl=:xl,suv=:suv,run_flat=:run_flat  WHERE id='$id'");
    $result = $stmt->execute($param);
    if($stmt->rowCount()>0){
        return $result;
    }else{
        return false;
    }
    //возвращает количество обновленных записей
    //или FALSE в случае отсутствия
}


function is_description($param){ //Функция проверяет сущетвует ли описание в базе данных
    $pdo = db_connect();
    $user = $_SESSION['user']; 
    $descr = $user.'_descr';
    $stmt = $pdo->prepare("SELECT id FROM $descr WHERE name=:name AND 
                            model=:model");
    $stmt->execute(array('name'=>$param['name'],'model'=>$param['model']));
    if($stmt->rowCount()>0){
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
    }else{
        return false;
    }
    //возвращает ID записи в случае присутствия
    //или FALSE в случае отсутствия
}


function update_description($param,$id){ //обновляет 
    $pdo = db_connect();
    $user = $_SESSION['user'];
    $descr = $user.'_descr';
    $stmt = $pdo->prepare("UPDATE $descr SET description = :description  WHERE id='$id'");
    $result = $stmt->execute(array('description'=>$param['description']));
    if($stmt->rowCount()>0){
        return $result;
    }else{
        return false;
    }
    //возвращает количество обновленных записей
    //или FALSE в случае отсутствия
}


function insert_description($param){ //Функция добавляет  запись в базу данных
    
    $pdo = db_connect();
    $user = $_SESSION['user']; 
    $descr = $user.'_descr';
    $stmt = $pdo->prepare("INSERT INTO $descr VALUES('null',:name,:model,:description)");
    $result = $stmt->execute(array('name'=>$param['name'],'model'=>$param['model'],'description'=>$param['description']));
    if($stmt){
        return $pdo->lastInsertId();
    }
    //возвращает lastInsertId в случае успешно добавления
}


function select_description($id){
    $pdo = db_connect();
    $user = $_SESSION['user'];
    $descr = $user.'_descr';
    
    $stmt = $pdo->prepare("SELECT description FROM $descr WHERE id = :id");
    $stmt->execute(array('id'=>$id));
    
    if($stmt->rowCount()>0){
         return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['description'];
    }else{
        return false;
    }
    //возвращает массив с записями в случае присутствия
    //или FALSE в случае отсутствия
}

function get_speed($index){
    $pdo = db_connect();
    $stmt = $pdo->prepare("SELECT value_speed FROM speed_convert WHERE ind_speed=:speed_index");
    $stmt->execute(array('speed_index'=>$index));
    if($stmt){
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['value_speed']; //ЗНАЧЕНИЕ СКОРОСТИ
    }else{
        return 'xxx';
    }
}

function get_load($index){
    $pdo = db_connect();
     $stmt = $pdo->prepare("SELECT value_load FROM load_convert WHERE ind_load=:load_index");
    $stmt->execute(array('load_index'=>$index));
    if($stmt){
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['value_load']; //ЗНАЧЕНИЕ НАГРУЗКИ
    }else{
        return 'xxx';
    }
}

function select_country($param){
    $pdo = db_connect();
    $user = $_SESSION['user']; 
    
    $stmt = $pdo->prepare("SELECT country FROM $user WHERE name=:name");
    $stmt->execute(array('name'=>$param['name']));
    
    if($stmt->rowCount()>0){
         return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['country'];
    }else{
        return;
    }
    //возвращает массив с записями в случае присутствия
    //или FALSE в случае отсутствия
}
    
function is_user($user){ //проверка существованияя поьщователя при регистрации
    $pdo = db_connect();
    $stmt = $pdo->prepare("SELECT id FROM users WHERE user=:user");
    $stmt->execute(array('user'=>$user));
    
    if($stmt->rowCount()>0){
        return true;
    }else{
        return false;
    }
}

function select_private(){  //получение ЧП
    $pdo = db_connect();
    $user = $_SESSION['user'];    
    $stmt = $pdo->prepare("SELECT private FROM users WHERE user=:user");
    $stmt->execute(array('user'=>$user));
        
    if($stmt->rowCount()>0){
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['private'];
    }else{
        return true;
    }
                
    
}
?>