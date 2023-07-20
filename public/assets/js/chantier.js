// let gd=document.querySelectorAll('section div article');
let aside=document.querySelector('aside');
let img1=document.querySelector('#img1');
let divDiv=document.querySelector('main div div');

// let previous;

// gd.forEach(element=>element.style.opacity='0');

/**
 * lors du click sur IMG ds aside, recup id target, fais boucle ttes gdes imgs, qd egalité, imgs opacité 1
 */
// aside.addEventListener(
//     'click',
//     (event)=>{
//         if(event.target.tagName=='IMG'){
//             if(img1.style.opacity=='1'){
//                 img1.style.opacity='0';
//             }else{
//                 previous.style.opacity='0';
//             }
    
//             // recu id parent de la target
//             let targete=event.target.parentNode.id;
//             // eneleve 5 prems caract pr laisser que nbrs
            
//             let nbrs=targete.slice(5);
    
//             let idd=[];
    
//             // rempli tab avec que nbr des ids des gds imgs
//             gd.forEach(element=>idd.push(element.getAttribute('id').slice(3)));
    
//             let size=idd.length;
            
//             // boucle->qd id target ==id gd img->cette img apparait
//             for(let i=0; i<size; i++){
//                 if(nbrs==idd[i]){
//                     previous=gd[i];
//                     previous.style.opacity='1';
//                 }
//             }
//         }

//     }
// )

function rtn(){
    window.history.back();
}

divDiv.style.display='none';
aside.addEventListener(
    'click',
    (event)=>{
        if(event.target.tagName=='IMG'){
            divDiv.style.display='block';
            let src=event.target.getAttribute('src');
            img1.setAttribute('src', src);

            let ID=event.target.parentNode.getAttribute('id').slice(5);
            console.log(ID);

            // divDiv.firstChild.innerHtml=`{{photo.${ID}.descImg}}`;
            // divDiv.firstChild.innerHtml=`{{photo.descImg}}`;
            divDiv.firstChild.style.background="blue";


        }
    }
);
    //je recup id de la target et je mets photo.id.descImg? 
