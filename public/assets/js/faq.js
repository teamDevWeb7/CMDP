
// section emplacement réponse à droite
let endroit=document.getElementById('rep');

// div qui contient quest 
let div=document.querySelectorAll('#quest div');

// tableau img
let img=document.querySelectorAll('#quest img');

let faqBtn=document.querySelectorAll('#quest button');
let quest=document.querySelector('#quest');
let faqSize=faqBtn.length;

quest.addEventListener(
    'click',
    (e)=>{
        if(e.target.tagName=='BUTTON'|| e.target.tagName=='IMG'){
            console.log(e.target.tagName)
            for(let i=0; i<faqSize; i++){
                
                if(faqBtn[i]==e.target || img[i]==e.target){
                        if(div[i].className=='hide'){
                        img.forEach(element=>element.style.rotate='0deg');
                        div.forEach(element=>element.classList.remove('show'));
                        div.forEach(element=>element.classList.add('hide'));
                        img[i].style.rotate='45deg';
                        div[i].classList.remove('hide');
                        div[i].classList.add('show');

                        }else{
                        img[i].style.rotate='0deg';
                        div[i].classList.remove('show');
                        div[i].classList.add('hide');
                    }
                }
            }
        }
    }
)



// fonctions rep pour injecter le texte de la réponse
function rep(){
    endroit.innerHTML='<p></p><br><q>https://www.economie.gouv.fr/dgccrf/Publications/Vie-pratique/Fiches-pratiques/Devis</q>>';
}
function rep1(){
    endroit.innerHTML='sdefghjik'
}


