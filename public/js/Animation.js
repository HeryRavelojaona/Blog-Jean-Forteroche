/** 
 * Classe de gestion des animations
 *
 */
class Animation {
    constructor(){
        this.AnimationScroll();
        this.ArrowUp();
    
    }
    //animation scrollReveal librarie
    AnimationScroll() {
         
        const sr = ScrollReveal();
        sr.reveal('h1', {
            origin: 'left',
            distance:'100px',
            scale: 0.3,
            duration: 2500 });

        sr.reveal('.bloc-billets', {
            origin: 'top',
            distance:'100px',
            duration: 2000 });
    }

    /*Show and hide arrow at scroll*/
    ArrowUp() {
        $(window).on('scroll',() =>{
            if(window.scrollY >400){
            $('.arrowUp').show();
            }else{
                $('.arrowUp').hide();
            }
         })
    }
}