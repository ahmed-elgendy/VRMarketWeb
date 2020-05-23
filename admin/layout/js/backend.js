$(function() {
    
    'use strict';
    //trigger the selectboxit 
     $("select").selectBoxIt({
         autoWidth:false
     });
    
    
    //hide placeholder
$('[placeholder]').focus(function() {
    
    $(this).attr('data-text',$(this).attr('placeholder'));
    $(this).attr('placeholder','');
})

    .blur(function() {
        
        $(this).attr('placeholder',$(this).attr('data-text'));
    });
    
    //add asterisk on required field 
    $('input').each(function () {
        if ($(this).attr('required') === 'required'){
           $(this).after('<span class= "asterisk">*</span>');
        }
    });
    
    //confirmation Message on button
    $('.confirm').click(function() {
        return confirm('Are You Sure?'); 
    });
    
    
    
    
});
