$(document).ready(function(e) {
 
     $(window).on('scroll',() =>{
        if(window.scrollY >400){
        $('.arrowUp').show();
    }else{
        $('.arrowUp').hide();
    }


     })
    
    //Tinymce
    tinymce.init({  selector:'textarea#admintext',
                    height : "480"
    });

    const animation = new Animation();

});