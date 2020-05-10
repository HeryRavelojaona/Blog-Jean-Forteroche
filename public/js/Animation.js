/** 
 * Classe de gestion des animations
 *
 */
class Animation {
    constructor(){
        this.AnimationScroll();
    
    }

    AnimationScroll() {
         //animation scrollReveal librarie
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

        sr.reveal('.navbar-brand', {
            origin: 'left',
            distance:'100px',
            rotate: {
                x: 0,
                y: 180,
                z: 0,
            },
            duration: 1000 });
    }

}