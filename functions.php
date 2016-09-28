<?php
 function check_opt_label($spike,$forspike,$xl,$suv,$runflat){ //проверка на наличие меток и вставка в общий массив
            if($spike != false) $spike = 1;
                else $spike = 0;
            if($forspike != false) $forspike = 1;
                else $forspike = 0;
            if($xl != false) $xl = 1;
                else $xl = 0;
            if($suv != false) $suv = 1;
                else $suv = 0;
            if($runflat != false) $runflat = 1;
                else $runflat = 0;
            
            $labels = array();
            $labels['spike'] = $spike;
            $labels['for_spike'] = $forspike;
            $labels['xl'] = $xl;
            $labels['suv'] = $suv;
            $labels['run_flat'] = $runflat;
            return $labels;
        }

function name_model_handling($final_array){
        
        $name = $final_array['name']; //присвоение переменным
        $model = $final_array['model'];
        
        $name = strtolower($name); //в нижний регистр
        $model = strtolower($model);
        
        if($name != 'Кама' && $name != 'Росава' && $name != 'Белшина'){ //уникальные правила формирования русских названий
        $model = str_ireplace(array(' ','-','/'),'_',$model);}
        
        $repl_from = array('nordman','Росава','Кама'); //замены в именах(русские символы чувств. к регистру)
        $repl_to = array('nokian','rosava','kama');
        $name = str_ireplace($repl_from,$repl_to,$name);
        
        $repl_from = array('hkpl','class_premier','rs','w606','w642','Евро','Бел','БЦ','nfera');//замены в моделях(русские символы чувств. к регистру)
        $repl_to = array('hakkapeliitta','classe_premiere','nordman_rs','w_606','w_642','euro','bel','bc','n~fera');
        $model = str_ireplace($repl_from,$repl_to,$model);
        
        $parser_param = array('name'=>$name,'model'=>$model);
        return $parser_param;
    }


function curl($url){                 
    $curl = curl_init();                      //инициализация
    curl_setopt($curl, CURLOPT_URL, $url);      //установка параметров
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $data = curl_exec($curl); //выполнение
    curl_close($curl);           //закрытие
    return $data;
}

function reset_key($array){
    $array = array_values($array);//сброс ключа массива
    if(isset($array[0])){
        $result = $array[0];
    }
    return $result;
}

function get_input_data_string($main_string){
            if($main_string!=''){
        $main_string = filter_input(INPUT_POST,'user_string',FILTER_SANITIZE_STRING); //удаление тегов
        $main_string = trim($main_string); //удал. начальных и конечных пробелов
        $main_string = ucwords($main_string); //Первая буква всех слов заглавная
            return $main_string;
        }else{
            return false;
        }
        
}


function parse_string($main_string){
    
    $spike = stristr($main_string,'шип');//определнение типа шины (шип)
    $forspike = stristr($main_string,'п/ш');//определнение типа шины (п/ш)
    $suv = stristr($main_string,'suv ');//определнение типа шины (suv)
    $xl = stristr($main_string,'xl');//определнение типа шины (xl)
    $runflat = stristr($main_string,'run flat');//определнение типа шины (run flat)
    
    $main_string = str_ireplace(array('xl','suv ','п/ш','шип','run flat'),'',$main_string);//удаление меток с непостоянным местонахождением(для более точного разбора)
    if(stristr($main_string,'good year')) $main_string = str_ireplace('good year','Goodyear',$main_string);//в случае если шина good_year

        $parse_result = preg_match_all          //разбор строки пользователя
        ('/^([\d]{3})\/([\d]{2})[R]+([0-9]{2})([cс]*)[\s]+([\wа-я]+[\s]+)([-\s0-9\wа-я\/_\+\.]*)[\s]+([0-9]{2,3})[\/]*([0-9]{2,3})*([\w]{1,2})/iu',
        $main_string, $output);
   
    if($parse_result){
        
        $element = array('','width','height','diameter','cargo','name','model',             //создание массива ключей для значний массива разбора
            'load_index','load_index_2','speed_index','country');
        
        
     
        for ($i = 1; $i < count($output); $i++){                //Слияние массивов
    
            if ($output[$i][0] != ''){                          //пустые заначения приравниваются нулю
                $final_array[$element[$i]] = trim($output[$i][0]); 
            }else{
                $final_array[$element[$i]] = 0;
            }
            
        }
        
$final_array['speed_index'] = str_ireplace(array('Т','Н','М','Р','К'),array('T','H','M','P','K'),$final_array['speed_index']);
        
        $labels = check_opt_label($spike,$forspike,$xl,$suv,$runflat);    //проверка на наличие меток
        if($final_array['cargo'] != false) $final_array['cargo'] = 1;      //приведение Cargo в bool
        $final_array =array_merge($final_array,$labels);
           
        return $final_array;
    }else{  
        return false;
    }
}




function curl_parse($final_array){
    
    if(!empty($final_array['name']) && !empty($final_array['model'])){   //если были определены имя и модель выполнять их обработку 
        $parser_param = name_model_handling($final_array); //получаем $parser_param с обработанным именем и моделью для удабного поиска
    }else{
        return false;
    }

    if (!@fsockopen("www.drom.ru", 80, $errno, $errstr, 30)) { //Проверка соединения
         return false;
    }

    $url = "http://www.drom.ru/shina/{$parser_param['name']}/"; //url для поиска
    $dataCurl = curl($url);

    if($dataCurl){

        $html = str_get_html($dataCurl); //подключаем simple_html_dom                       
        if($html->innertext!='' and count($html->find('h3 a'))){ //проверяем есть ли результаты
            $urlList = array();
            foreach($html->find('h3 a') as $description)
                $urlList[] = $description->href; //создаем массив со ссылками в соответствии с именем
        }
        $html->clear(); //освобождение ресурсов
        unset($html); //удаление переменной

    }else{
         return false;
    }

       
//--------------------------------------LINK-LIST->LINK-------------------------------------------//
    if(isset($urlList)){
    $url = preg_grep('/'.$parser_param['model'].'/',$urlList);//получение нужного URL из списка по названию модели
    }else{
        return false;
    }

//--------------------------------------LINK->DESCR or LINK-LIST-------------------------------------------//
    if($url){               //поиск описания по готовой ссылке или вывод списка для выбора
        $url = reset_key($url); //сброс ключа 

        $dataCurl = curl($url);
        $html = str_get_html($dataCurl); 
        if($html->innertext!='' and count($html->find('span#text_preview'))) {
        $description = $html->find('span#text_preview')[0];
        }
        $description = filter_var($description,FILTER_SANITIZE_STRING); //очистка описания от тегов
        //$description = htmlspecialchars($description);
        if(isset($description) && $description != 'Посмотреть отзывы о других моделях шин'){
        
            return $description; //если описание найдено возвращаем его
        
        $html->clear(); //освобождение ресурсов
        unset($html); //удаление переменной
        }else{
             return false;
        }
    
    }else{
        //если описание не найдено возвращаем массив ссылок 
                $result = array();
                foreach($urlList as $url){
                    $result[] = "<a target='blank' href='".$url."'>".ucfirst(basename($url))."<a>";
                }
              return $result; //если описание не найдено возвращаем массив ссылок 
    }
    
    
}

function destroySession()   //функция удаления сессии
{

    $_SESSION = array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(),'',time()-2592000,'/');

    session_destroy();
}

?>