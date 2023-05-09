let p=document.querySelectorAll('.suppress');
let modale=document.querySelectorAll('#tof .suppr');
let trSize=p.length;
let btnSpr=document.querySelectorAll('#tof button');

let mod=document.querySelector('#supprChan');


let content=[document.querySelector('h1'), document.querySelector('#att'), document.querySelector('#tof'), document.querySelector('p'), document.querySelector('.opts')];


function shutDown2(e){
    mod.classList.remove('attaque');
    mod.classList.add('agentDormant');
    for(let j=0; j<5; j++){
        content[j].classList.remove('blur');
    }

}

function supprChan(){
    mod.classList.remove('agentDormant');
    mod.classList.add('attaque');
    for(let j=0; j<5; j++){
        content[j].classList.add('blur');
    }
}



console.log(modale);
console.log(p)
document.addEventListener('click',
    (e)=>{
        if(e.target.tagName=='P'){
            console.log(e.target)
            for(let i=0; i<trSize; i++){
                if(e.target==p[i]){
                    console.log(modale[i]);
                    modale[i].classList.remove('agentDormant');
                    modale[i].classList.add('attaque');

                }
            }
            for(let j=0; j<5; j++){
                content[j].classList.add('blur');
            }
        }

    }
)
