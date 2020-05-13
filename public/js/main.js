$(document).ready(function(e) {
 
    //Tinymce
    tinymce.init({  selector:'textarea#admintext',
                    height : "480"
    });
    tinymce.init({  selector:'.title-billet-add',
                    height : "250"
    });

    const animation = new Animation();

    //Validation before Delete
    $('.check-delete').click(function(e){
        e.preventDefault();
        if($('.go-delete').hide()){
            $('.btnAdmin').hide();
            $('.go-delete').show();
            $('.stop-delete').click(function(){
                $('.go-delete').hide();
                $('.btnAdmin').show();
            });
        }else {
            $('.btnAdmin').show();
        }
    });

});