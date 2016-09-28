$(document).ready(function(){

    $('.delete_control').click(function(){
        
        current_tag = $(this).parent('li');
        var tag_id = $(this).parent('li').attr('data-id');
        
        $.ajax({
        type: 'POST',
        url: 'delete_from_db.php',
        data: 'tag_id='+tag_id,
        
        success: function(obj){     
            
                if(obj){
                     current_tag.slideUp(300);
                }else{
                    alert('Невозможно удалить запись ID'+tag_id)
                }
            }
        })
    })
    
    
    
    $('#clear_form').click(function(){
        
        for (var it in $.cookie()){
            
            if(it == 'PHPSESSID') continue
            $.removeCookie(it);
            
            var id = it
            $('li[data-id='+id+']').css({backgroundColor: 'rgba(0, 0, 0, 0)'});
            $('li[data-id='+id+'] .print_control').css({backgroundImage:'url(../images/print.png)'})
            $('li[data-id='+id+']').find('.delete_control').show(500);
            $('li[data-id='+id+']').removeClass('class');
            
            $('li[data-id='+id+']').find('.fields input').removeAttr('disabled');
            $('li[data-id='+id+']').find('.fields select').removeAttr('disabled');
        } 
  
    })
    
    for (var it in $.cookie()){
            
            var id = it
            $.cookie(id,[$.cookie(id)])//запись в куки
            
            $('li[data-id='+id+']').addClass('class');
            $('li[data-id='+id+']').css({backgroundColor:'#9D9D9D'});
            $('li[data-id='+id+'] .print_control').css({backgroundImage:'url(../images/print_hover.png)'})
            $('li[data-id='+id+']').find('.delete_control').hide();
            
            $('li[data-id='+id+']').find('.fields input').attr('disabled','disabled');
            $('li[data-id='+id+']').find('.fields select').attr('disabled','disabled');
        
    } 

      $('.print_control').click(function(){
        
            if(!$(this).parent('li').hasClass('class')){
            
            var price = $(this).parent('li').find('.fields input[name=price]').val();
            var country = $(this).parent('li').find('.fields input[name=country]').val();
            var count = $(this).parent('li').find('.fields select[name=count]').val();
            
            var id = $(this).parent('li').attr('data-id')
            $.cookie(id,[price,country,count])//запись в куки
            
                        
            $(this).parent('li').addClass('class');
            $(this).parent('li').css({backgroundColor:'#9D9D9D'});
            $(this).css({backgroundImage:'url(../images/print_hover.png)'})
            $(this).parent('li').find('.delete_control').hide(500);
            
            $(this).parent('li').find('.fields input').attr('disabled','disabled');
            $(this).parent('li').find('.fields select').attr('disabled','disabled');
            
        }else{
            
            var id = $(this).parent('li').attr('data-id')//запись из куки
            $.removeCookie(id); 
            
            $(this).parent('li').css({backgroundColor: 'rgba(0, 0, 0, 0)'});
            $(this).css({backgroundImage:'url(../images/print.png)'})
            $(this).parent('li').find('.delete_control').show(500);
            $(this).parent('li').removeClass('class');
            
            $(this).parent('li').find('.fields input').removeAttr('disabled');
            $(this).parent('li').find('.fields select').removeAttr('disabled');
        }
        
    })
     
}) //конец скрипта