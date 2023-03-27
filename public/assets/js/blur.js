// pour a propos, blur des img dans nos réalisations

let n1=document.getElementById('n1');
let n2=document.getElementById('n2');
let n3=document.getElementById('n3');

n1.addEventListener(
    "mouseover",
    (event) => {
        n2.setAttribute("class", "blur");
        n2.style.height="69.5vh";
        n2.style.top="3px";
    }
)
n1.addEventListener(
    "mouseout",
    (event)=>{
        n2.setAttribute("class", "norm");
        n2.style.height="70vh";
        n2.style.top="0px";
    }
)

n3.addEventListener(
    "mouseover",
    (event) => {
        n2.setAttribute("class", "blur");
        n2.style.height="69.5vh";
        n2.style.top="3px";
    }
)
n3.addEventListener(
    "mouseout",
    (event)=>{
        n2.setAttribute("class", "norm");
        n2.style.height="70vh";
        n2.style.top="0px";
    }
)