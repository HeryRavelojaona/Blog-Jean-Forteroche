$(document).ready(function() {
    //Tinymce
    tinymce.init({  selector:'textarea#admintext',
                    height : "480"

    });

    //scrollspy
    $(".navbar a").on('click',function(event){
		event.preventDefault();
		let hash=this.hash;

		$('body,html').animate({scrollTop:$(hash).offset().top},900,function(){window.location.hash=hash;})
	});	


});