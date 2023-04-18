let burger=document.querySelector('#burger');
let menuBurg=document.querySelector('#menuBurg');
let salut=false;

// burger.addEventListener("click",
//     ()=>{
//         menuBurg.classList.toggle('salut');
//     })

burger.addEventListener('click',
    ()=>{
        if(salut==false){
            menuBurg.classList.add('salut');
            menuBurg.classList.remove('cacheToi');
            salut=true;
        }else{
            menuBurg.classList.remove('salut');
            menuBurg.classList.add('cacheToi');
            salut=false;
        }
    })
