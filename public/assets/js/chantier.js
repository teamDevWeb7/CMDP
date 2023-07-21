let aside=document.querySelector('aside');
let img1=document.querySelector('#img1');
let divDiv=document.querySelector('main div div');

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

            let desc=event.target.nextSibling.textContent;

            divDiv.firstChild.textContent=desc;
        }
    }
);

