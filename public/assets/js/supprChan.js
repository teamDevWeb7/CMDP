let p=document.querySelectorAll('.suppress');
let modale=document.querySelectorAll('#tof .suppr');
let trSize=p.length;
let btnSpr=document.querySelectorAll('#tof button');

let mod=document.querySelector('#supprChan');


let content=[document.querySelector('h1'), document.querySelector('#att'), document.querySelector('p'), document.querySelector('.opts')];
let arts=document.querySelectorAll('#tof article');


function shutDown2(){
    mod.classList.remove('attaque');
    mod.classList.add('agentDormant');
    for(let j=0; j<4; j++){
        content[j].classList.remove('blur');
    }
    arts.forEach(element=>element.classList.remove('blur'));

}

function supprChan(){
    mod.classList.remove('agentDormant');
    mod.classList.add('attaque');
    for(let j=0; j<4; j++){
        content[j].classList.add('blur');
    }
    arts.forEach(element=>element.classList.add('blur'));
}



document.addEventListener('click',
    (e)=>{
        if(e.target.className=='suppress'){
            for(let i=0; i<trSize; i++){
                if(e.target==p[i]){
                    modale[i].classList.remove('agentDormant');
                    modale[i].classList.add('attaque');

                }
            }
            for(let j=0; j<4; j++){
                content[j].classList.add('blur');
            }
            arts.forEach(element=>element.classList.add('blur'));
        }

    }
)

function shutDown3(e){
    for(let i=0; i<trSize; i++){
        if(e.target==btnSpr[i]){
            modale[i].classList.remove('attaque');
            modale[i].classList.add('agentDormant');
            for(let j=0; j<4; j++){
                content[j].classList.remove('blur');
            }
            arts.forEach(element=>element.classList.remove('blur'));

        }
    }
}
