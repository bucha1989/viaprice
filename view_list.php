<?php
session_start();


if(!$record)die("База данных пуста  <a href='index.php'>Вернуться на главную</a>");

echo '<ul id="main_list">';

foreach($record as $one){
    
    
    if($one['load_index_2']>0)$load_index_2 = '/'.$one['load_index_2'];
    else $load_index_2 ='';
    
    if($one['cargo']>0)$cargo = 'C';
    else $cargo ='';
    
    echo "<li class='row' data-id='{$one['id']}'>
            <span class='print_control'></span>
            <span class='size'>{$one['width']}/{$one['height']}R{$one['diameter']}{$cargo}</span>&nbsp;&nbsp;
            <span class='name'>{$one['name']} {$one['model']}</span> &nbsp;&nbsp;
            <span class='other'>
            
            {$one['load_index']}{$load_index_2}{$one['speed_index']} ({$one['country']})</span>
            
            <span class='delete_control'></span>
            <span class='fields'>
             <select name='count'>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4' selected='' >4</option>
                <option value='5'>5</option>
                <option value='6'>6</option>
                <option value='7'>7</option>
                <option value='8'>8</option>
                <option value='9'>9</option>
                <option value='10'>10</option>
                <option value='11'>11</option>
                <option value='12'>12</option>
             </select>
            </span>

            <span class='fields'><input type='text' maxlength='15' size='10' placeholder='страна' name='country' value='{$one['country']}' /></span>
            <span class='fields'><input type='text' maxlength='5' size='2' placeholder='цена' name='price' /></span>
            
            
            
        </li>";
}

echo '</ul>';
?>