let loading=document.querySelector('.loade');

window.addEventListener('onload',()=>{
    loading.classList.remove('meringue');
})

window.addEventListener('load',()=>{
    loading.classList.add('meringue');
})