function searcher(){
    const needle = document.querySelector('#search').value;
    const divette = document.querySelector('#azerty');

    if(needle.length>2){
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/ajax/prospect/'+needle);
        xhr.responseType='text';
        xhr.onload=function(){
            divette.setAttribute('style', 'display:block;');
            divette.innerHTML=xhr.responseText;
            console.log(xhr.responseText);
        };
        xhr.send();
    }else{
        divette.setAttribute('style', 'display:none;');
    }
    
}

function input(){
    const needle = document.querySelector('#searche').value;
    const divettee = document.querySelector('#azert');

    if(needle.length>2){
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/ajax/chantier/'+needle);
        xhr.responseType='text';
        xhr.onload=function(){
            divettee.setAttribute('style', 'display:block;');
            divettee.innerHTML=xhr.responseText;
            console.log(xhr.responseText);
        };
        xhr.send();
        console.log(needle);
    }else{
        divettee.setAttribute('style', 'display:none;');
    }
    
}