let art=document.querySelectorAll('section div article');
let imgs=document.querySelectorAll('section div article img');
let aside=document.querySelector('aside');
let outer=[];
let tab=[];


// imgs.forEach(element=>outer+=element.outerHTML);
// console.log(outer);
// console.log(imgs);


// let chaine=outer.split('<');
// console.log('<'+chaine[1]);

aside.addEventListener(
    'click',
    (event)=>{
        // check égal obj va pas pck check instance->va retourner false



        // art.forEach(element=>element.style.opacity='0');
        let targete=event.target;
        // targete.toString();
        console.log(targete);
        // console.log(imgs[1]);
        // console.log(targete.currentSrc);
        // console.log(targete.src);
        // let targo=JSON.stringify(targete);


        let size=imgs.length;

        // imgs.forEach(element=>tab+=JSON.stringify(element));
        
        // for(let i=0; i<size; i++){
        //     if(tab[i]===targo){
        //         console.log('salut');
        //     }
        // }


        for(let i=0; i<size; i++){
            if(_.isEqual(imgs[i], targete)){
                console.log('matinée');
            }else{
                console.log('chocolatine');
            }
        }


        // console.log(size);

        // for(let i=0; i<size; i++){
        //     if(targete=='<'+chaine[i]){
        //         console.log('ca marche');
        //     }
        // }

        // for(let j=0; j<size; j++){
        //     if(targete==imgs[j]){
        //         art[j].style.opacity='1';
        //         console.log('wesh');
        //     }
        // }

        // for(let i=0; i<size; i++){
        //     if(imgs[i]==targete){
        //         art[i].classList.remove('derriere');
        //         art[i].classList.add('devant');
        //     }else{
                
        //         art[i].classList.add('derriere');
        //         art[i].classList.remove('devant');
        //     }
        // }

        // for(let i=0; i<size; i++){
        //     if(imgs[i]!=targete){
        //         console.log('cc');
        //         console.log('a'+imgs[i]+'a');
                
        //     }else{
        //         // art[i].style.filter='blur(4px)';
        //         // art[i].style.display='none';
        //         console.log(imgs[i]);
        //     }
        // }
    }
)

