// afficher/cacher questions mobile
let showQuest=document.querySelector('my-div');
let closede=document.querySelector('#quests p');
let mesQuests=document.querySelector('#quests');

function questions(){
    mesQuests.classList.add('hola');
    mesQuests.classList.remove('tschuss');
}

function closeded(){
    mesQuests.classList.remove('hola');
    mesQuests.classList.add('tschuss');
}

// 