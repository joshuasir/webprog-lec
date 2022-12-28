$(function(){
    
    $(window).on('scroll',function(){
        
        if($('title').text() !== 'Home') return;
        if($(window).scrollTop()<=20){
            $('.navbar').css( 'background-color','transparent');
        }else{
            $('.navbar').css( 'background-color','#201e1e');
        }
    });
});