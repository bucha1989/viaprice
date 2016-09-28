$(document).ready(function(){
    
    



button_show_or_not(); //проверка на правильность заполненности формы
$('#notice p.notice').text('')//очищаем поле ошибок



$('#submit_parse').click(function(event){  //при нажатии кнопки РАЗБОР

    
    $('#big_block').slideUp(500);
    $('#big_block').html('');
        
    remove_form_param()//очистка предыдущей записи
    event.preventDefault()//отмена стандартного события
    
    var user_string = $('#user_string').val() //присвоение переменной значения из формы
    
    $.ajax({
        type: 'POST',
        url: 'get_all_data.php',
        beforeSend:function(){   //функции лоадера
            $('#notice').slideUp(200)  
            $('#loader').slideDown(200)
            $('#submit_parse').slideUp(200)
            $('#form_to_db').slideUp(200)
            $('#notice_form').slideUp(200);
        },
        complete:function(){     //функции лоадера
            $('#loader').slideUp(200)
            $('#form_to_db').slideDown(200)
            $('#submit_parse').slideDown(200)
            button_show_or_not()
            
        },
        data: 'user_string='+user_string,
        success: function(obj){
            
                   
                    
                    var data = JSON.parse(obj) //json => object JS
                    
                    if(data.model && !data.error){ 
                        
                        $('#notice').slideUp(200)   //скрытие поля ошибок
                        form_param(data)    //добавление значений в форму
                        add_to_example()         
                    if(data.description_array){
                         var destination = $('#big_block').offset().top+60; //скроллим к списку
                            $('body').animate({ scrollTop: destination }, 1000);
                    }else{
                         var destination = $('#footer').offset().top; //скроллим к форме
                        $('body').animate({ scrollTop: destination }, 500);
                    }
                       
                        
                        
                    }else{
                        $('#notice').slideDown(200,function(){
                            $(this).find('p.notice').text(data.error)
                        })
                    }
                    
        }       
    })
}) //при нажатии кнопки РАЗБОР(конец)
    
    
    

$('#submit_form').click(function(event){        //при нажатии кнопки ДОБАВИТЬ
    event.preventDefault()                    //отмена стандартного события
    $('#notice_form').slideUp(200)             //скрытие поля ошибок
    
    sel_data = select_form_data()
    
    $.ajax({
        type: 'POST',
        url: 'add_to_db.php',
        data: 'select_form_data='+$.toJSON(sel_data),
        success: function(obj){     
            if(obj){$('#notice').slideDown(200)
                $('#notice p.notice').text(obj)
                var destination = $('#user_string').offset().top-100; //скроллим к форме
                        $('body').animate({ scrollTop: destination }, 500);
                }
            }
    })
    
})    //при нажатии кнопки ДОБАВИТЬ(конец)


$('#clear_form').click(function(event){        //при нажатии кнопки Очистить   
    event.preventDefault()
    $('#notice_form').slideUp(200)
    
    remove_form_param()
    remove_form_parse()
    button_show_or_not()
    $('#notice_form').slideDown(200,function(){
        $(this).find('p.notice').text("Форма очищена")
    })
    
})




$('body').on('click','#decr_list li',function(event){  //нажатие на элементе списка и присвоение описания
    
    event.preventDefault()
    $('#notice_form').slideUp(200)
    
    var url = $(this).find('a').attr('href')
    
    $.ajax({
        type: 'POST',
        url: 'get_descr_from_list.php',
        beforeSend:function(){   //функции лоадера
            $('#notice_form').slideDown(200,function(){
                $(this).find('p.notice').html("Загрузка описания <img class='small_loader' src='images/loader2.gif' />")
            })
        },
        complete:function(){     //функции лоадера
            $('#notice_form').slideUp(200)
            button_show_or_not()
            var destination = $('#description').offset().top; //скроллим к описанию
            $('body').animate({ scrollTop: destination }, 500);
        },
        data: 'url='+url,
        success: function(obj){
            
            if(obj!=''){
                $('#form_to_db textarea').val(obj)
            }else{
                $('#form_to_db textarea').val('Описание не найдено')
            }
        }
    })
}) 


$('#form_to_db').keyup(function(){  //при нажатии кнопки на любом элементе формы
    
    
    button_show_or_not()
    add_to_example()
    
})

$('#form_to_db input[type=checkbox]').change(function(){  //при нажатии кнопки на любом элементе формы
    
    add_to_example()
    
})
//--------------------------------------Заполнение Exampel price_tag... -------------------------------------------//




}) //конец скрипта