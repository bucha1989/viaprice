$(document).ready(function(){
        
 $('input[name=login]').keyup(function(){//проверка допустимости ПОЛЬЗОВАТЕЛЯ
            
             user = $(this).val()
        $.ajax({
        type: 'POST',
        url: 'is_user.php',
        data: 'user='+user,
        success: function(obj){     
            
                if(obj || user.length<3){    //если пользователь существует
                   $('.fontawesome-user').css({color:'#FE5621'});
                   $('#pass_pgf').slideUp(500)
                             
                }else{      //если пользователь НЕ существует
                    
                    if(user==''){
                        $('.fontawesome-user').css({color:'#eee'});
                         $('#pass_pgf').slideUp(500)
                    }else{
                        
                        $('.fontawesome-user').css({color:'#8AC249'});
                        $('#pass_pgf').slideDown(500)
                        
                    }
                    
                }
            
            }
    })
            
})

$('input[name=pass]').keyup(function(){   //проверка допустимости ПАРОЛЯ
            
        pass = $(this).val()
            
        $.ajax({
        type: 'POST',
        url: 'check_pass.php',
        data: 'pass='+pass,
        success: function(obj){     
            
                if(obj || (pass==user) || pass.length<6){    //если пользователь существует
                   $('.fontawesome-lock').css({color:'#FE5621'});
                   $('input[type=submit]').attr('disabled','disabled'); //блокировка кнопки отправки
                                    
                }else{      //если пользователь НЕ существует
                    $('.fontawesome-lock').css({color:'#8AC249'});
                    if(pass=='')$('.fontawesome-lock').css({color:'#eee'});
                    
                    $('input[type=submit]').removeAttr('disabled');//разблокировка кнопки отправки
                }
            
            }
    })
            
})  
        
        
        
    })//конец скрипта
    