let p=document.querySelectorAll('.suppress');
let modale=document.querySelectorAll('.suppr');
let trSize=p.length;
let btnSpr=document.querySelectorAll('main button');
let table=document.querySelector('table');

console.log(modale);
console.log(p)
document.addEventListener('click',
    (e)=>{
        if(e.target.tagName=='P'){
            table.classList.remove('normal');
            table.classList.add('blur');
            console.log(e.target)
            for(let i=0; i<trSize; i++){
                if(e.target==p[i]){
                    modale[i].classList.remove('agentDormant');
                    modale[i].classList.add('attaque');

                }
            }
        }

    }
)

function shutDown(e){
    for(let i=0; i<trSize; i++){
        if(e.target==btnSpr[i]){
            modale[i].classList.remove('attaque');
            modale[i].classList.add('agentDormant');
            table.classList.remove('blur');
            table.classList.add('normal');
        }
    }
}