let p=document.querySelectorAll('.suppress');
let modale=document.querySelectorAll('.suppr');
let trSize=p.length;
let btnSpr=document.querySelectorAll('main button');
let table=document.querySelector('table');

let contenu=[document.querySelector('h1'), document.querySelector('p')]
let tables=document.querySelectorAll('table');
let h2=document.querySelectorAll('h2');
let opts=document.querySelectorAll('.opts');
let moda=document.querySelector('.suppre');

let path='';
path=window.location.pathname;
let $miniPath='';
for(let i=0; i<16; i++){
    $miniPath+=path[i];
}

document.addEventListener('click',
    (e)=>{
        if(e.target.className=='suppress'){
            console.log(e.target.className)
            for(let i=0; i<trSize; i++){
                if(e.target==p[i]){
                    modale[i].classList.remove('agentDormant');
                    modale[i].classList.add('attaque');
                }
            }
            if($miniPath=='/admin/prospect/'){
                contenu.forEach(element=>element.classList.add('blur'));
                tables.forEach(element=>element.classList.add('blur'));
                h2.forEach(element=>element.classList.add('blur'));
                opts.forEach(element=>element.classList.add('blur'));
            }else{
                table.classList.remove('normal');
                table.classList.add('blur');

            }

        }
        if(e.target.className=='suppresse'){
            moda.classList.remove('agentDormant');
            moda.classList.add('attaque');
            contenu.forEach(element=>element.classList.add('blur'));
            tables.forEach(element=>element.classList.add('blur'));
            h2.forEach(element=>element.classList.add('blur'));
            opts.forEach(element=>element.classList.add('blur'));
        }

    }
)

function shutDown(e){
    for(let i=0; i<trSize; i++){
        console.log(btnSpr)
        if(e.target==btnSpr[i]){
            modale[i].classList.remove('attaque');
            modale[i].classList.add('agentDormant');
            if($miniPath=='/admin/prospect/'){
                contenu.forEach(element=>element.classList.remove('blur'));
                tables.forEach(element=>element.classList.remove('blur'));
                h2.forEach(element=>element.classList.remove('blur'));
                opts.forEach(element=>element.classList.remove('blur'));
            }else{
                table.classList.remove('normal');
                table.classList.add('blur');

            }

        }
    }
}

function shutDowne(){
    moda.classList.add('agentDormant');
    moda.classList.remove('attaque');
    contenu.forEach(element=>element.classList.remove('blur'));
    tables.forEach(element=>element.classList.remove('blur'));
    h2.forEach(element=>element.classList.remove('blur'));
    opts.forEach(element=>element.classList.remove('blur'));
}