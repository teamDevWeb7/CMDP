const byebyeToasts=setTimeout(byebyeToast, 5000);
let toasts=document.querySelectorAll('.toast');
let nbToasts=toasts.length;

function byebyeToast(){
    for(let i=0; i<nbToasts; i++){
        toasts[i].setAttribute('class', 'disapeared');
    }
    
}