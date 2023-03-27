const byebyeToasts=setTimeout(byebyeToast, 5000);

function byebyeToast(){
    document.querySelector('.toast').setAttribute('class', 'disapeared');
}