$(function(){
    $(window).on('scroll',function(){
        if($(window).scrollTop()<=20){
            $('.navbar').css( 'background-color','transparent');
        }else{
            $('.navbar').css( 'background-color','#201e1e');
        }
    });
});