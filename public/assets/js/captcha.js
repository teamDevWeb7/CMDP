let btn =document.querySelector('#btn');

document.querySelector('form').addEventListener(
    "mouseover",
    (event)=>{
        let rep = grecaptcha.getResponse();
        if(rep.length == 0){
            btn.disabled=true;
        }else{
            btn.disabled=false;
        }
    }
)