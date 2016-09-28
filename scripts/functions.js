function form_param(data){         //добавление значений в форму кроме описания               
    //text
    $('#form_to_db input[name=width]').val(data.width);
    $('#form_to_db input[name=height]').val(data.height);
    $('#form_to_db input[name=diameter]').val(data.diameter);
    $('#form_to_db input[name=name]').val(data.name);
    $('#form_to_db input[name=model]').val(data.model);
    $('#form_to_db input[name=load_index]').val(data.load_index);
    $('#form_to_db input[name=speed_index]').val(data.speed_index);
    $('#form_to_db input[name=country]').val(data.country);
  
    if(data.load_index_2) $('#form_to_db input[name=load_index_2]').val(data.load_index_2);
                        
    //Checkbox
    if(data.cargo)$('#form_to_db input[name=cargo]').prop('checked',true);
    if(data.xl)$('#form_to_db input[name=xl]').prop('checked',true);
    if(data.for_spike)$('#form_to_db input[name=for_spike]').prop('checked',true);
    if(data.spike)$('#form_to_db input[name=spike]').prop('checked',true);
    if(data.run_flat)$('#form_to_db input[name=run_flat]').prop('checked',true);
    if(data.suv)$('#form_to_db input[name=suv]').prop('checked',true);
 
    //textatea
    if(data.description)$('#form_to_db textarea').val(data.description);
    //list
    if(data.description_array){
        $('#big_block').fadeIn(500);
        $('#big_block').append("<span id='model_list_title'>Не удалось найти подходящее ОПИСАНИЕ, возможно вы сможете его найти в этом списке</span><br /><br />");
        $('#big_block').append("<ol id='decr_list'>");
    
        for(i=0;i<data.description_array.length;i++){
            $('#decr_list').append("<li>"+data.description_array[i]+"</li>");
        }
    };
 
    return;
}
 
 
function remove_form_param(){         //удаление значений из формы кроме описания               
    //text
    $('#form_to_db input[type=text]').val('')
    //Checkbox
    $('#form_to_db input[type=checkbox]').prop('checked',false);
    //textatea
    $('#form_to_db textarea').val('')
    return
}
 
function remove_form_parse(){
    $('#form_parse input').val('')
    return
}
 
 
function select_form_data(){
    form_data = new Object();
     //text
    form_data.width = $('#form_to_db input[name=width]').val();
    form_data.height = $('#form_to_db input[name=height]').val();
    form_data.diameter = $('#form_to_db input[name=diameter]').val();
    form_data.name = $('#form_to_db input[name=name]').val();
    form_data.model = $('#form_to_db input[name=model]').val();
    form_data.load_index = $('#form_to_db input[name=load_index]').val();
    form_data.speed_index = $('#form_to_db input[name=speed_index]').val();
    form_data.country = $('#form_to_db input[name=country]').val();
    
    if($('#form_to_db input[name=load_index_2]').val()!='')
        {form_data.load_index_2 = $('#form_to_db input[name=load_index_2]').val()}
    else{
        form_data.load_index_2 = 0;
    }
     //Checkbox
    if($("#form_to_db input[name=cargo]").is(':checked'))
    {form_data.cargo = 1}else{
        form_data.cargo = 0
    }
    if($("#form_to_db input[name=xl]").is(':checked'))
    {form_data.xl = 1}else{
        form_data.xl = 0
    }
    if($("#form_to_db input[name=for_spike]").is(':checked'))
    {form_data.for_spike = 1}else{
        form_data.for_spike = 0
    }
    if($("#form_to_db input[name=spike]").is(':checked'))
    {form_data.spike = 1}else{
        form_data.spike = 0
    }
    if($("#form_to_db input[name=run_flat]").is(':checked'))
    {form_data.run_flat = 1}else{
        form_data.run_flat = 0
    }
    if($("#form_to_db input[name=suv]").is(':checked'))
    {form_data.suv = 1}else{
        form_data.suv = 0
    }
    //textatea
    form_data.description = $('#form_to_db textarea').val()
    
    form_data.description = form_data.description.replace(/[^A-Za-zА-Яа-яЁё\s\.\_\/\\,-]/g, "") //очистка от ненужных символов
    
    return form_data;
 }
 
 function form_validation(){
        
        if($('#form_to_db input[name=width]').val() == ''){
            return false;
        }
        
        if($('#form_to_db input[name=height]').val() == ''){
            return false;
        }
        
        if($('#form_to_db input[name=diameter]').val() == ''){
            return false;
        }
        
        if($('#form_to_db input[name=name]').val() == ''){
            return false;
        }
        
        if($('#form_to_db input[name=model]').val() == ''){
            return false;
        }
        
        if($('#form_to_db input[name=load_index]').val() == ''){
            return false;
        }
        
        if($('#form_to_db input[name=speed_index]').val() == ''){
            return false;
        }
        
        if($('#form_to_db input[name=country]').val() == ''){
            return false;
        }
        
        return true;
 }
 
function button_show_or_not(){
    var count = $('#form_to_db textarea').val();
    count = count.length;
    $(".form_info b").html(count);
    if(count > 350){
        $('#submit_form').slideUp(200);
        $('.main').slideUp(200);
        $('#notice_form').slideDown(200,function(){
            $(this).find('p.notice').text("Поле с описанием должно содержать не более 350 символов")
        })
    }else if(!form_validation()){
        $('#submit_form').slideUp(200)
        $('.main').slideUp(200)
        $('#notice_form').slideDown(200,function(){
            $(this).find('p.notice').text("Заполнены не все обязательные поля")
        })
    }else{
        $('#notice_form').slideUp(200);
        $('#submit_form').slideDown(200)
        $('.main').slideDown(200)
    }
    return
}


function add_to_example(){
    //text
    form_width = $('input[name=width]').val();
    form_height = $('input[name=height]').val();
    form_diameter = $('input[name=diameter]').val();    
    form_name = $('input[name=name]').val();
    form_model = $('input[name=model]').val();
    form_load_index = $('input[name=load_index]').val();
    description = $('textarea[name=description]').val();
    
    
    if($('input[name=load_index_2]').val()>0){
        form_load_index_2 = '/'+$('input[name=load_index_2]').val();
    }else{
        form_load_index_2 = ''
    }
    
    form_speed_index = $('input[name=speed_index]').val();
    form_country = $('input[name=country]').val();
    
    $('#labels').html('');
    //checkbox
    if($("#form_to_db input[name=suv]").is(':checked')){
        $('#labels').append('<div class="item"><img src="images/suv.png" /></div>')
    }
    
    if($("#form_to_db input[name=xl]").is(':checked')){
        $('#labels').append('<div class="item"><img src="images/xl.png" /></div>')
    }
    
    if($("#form_to_db input[name=cargo]").is(':checked')){
        $('#labels').append('<div class="item"><img src="images/cargo.png" /></div>')
    }
    
    if($("#form_to_db input[name=run_flat]").is(':checked')){
        $('#labels').append('<div class="item"><img src="images/run_flat.png" /></div>')
    }
    
    if($("#form_to_db input[name=for_spike]").is(':checked')){
        $('#labels').append('<div class="item"><img src="images/for_spike.png" /></div>')
    }
    
    if($("#form_to_db input[name=spike]").is(':checked')){
        $('#labels').append('<div class="item"><img src="images/spike.png" /></div>')
    }
    

if($("#form_to_db input[name=cargo]").is(':checked')){
    cargo = 'C'
}else{
     cargo = ''
}

$('#size').text(form_width+'/'+form_height+' R'+form_diameter+''+cargo+' '+form_load_index+''+form_load_index_2+''+form_speed_index);


$('#name').text(form_name+' '+form_model);

$('#brief_speed_index').text('Индекс скорости '+form_speed_index+':');

$('#country_value').text(form_country);

$('#brief_load_index').text('Индекс нагрузки '+form_load_index+''+form_load_index_2+':');

$('#descr').text(description);
return
}