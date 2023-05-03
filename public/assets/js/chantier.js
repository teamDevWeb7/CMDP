let gd=document.querySelectorAll('section div article');
let aside=document.querySelector('aside');
let img1=document.querySelector('#img1');

gd.forEach(element=>element.style.opacity='0');

/**
 * lors du click sur aside, recup id target, fais boucle ttes gdes imgs, qd egalité, imgs opacité 1
 */
aside.addEventListener(
    'click',
    (event)=>{
        img1.style.opacity='0';
        gd.forEach(element=>element.style.opacity='0');

        // recu id parent de la target
        let targete=event.target.parentNode.id;
        // eneleve 5 prems caract pr laisser que nbrs
        let nbrs=targete.slice(5);

        let idd=[];

        // rempli tab avec que nbr des ids des gds imgs
        gd.forEach(element=>idd.push(element.getAttribute('id').slice(3)));

        let size=idd.length;
        
        // boucle->qd id target ==id gd img->cette img apparait
        for(let i=0; i<size; i++){
            if(nbrs==idd[i]){
                gd[i].style.opacity='1';
            }
        }
    }
)
