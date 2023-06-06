const bar = document.getElementById('bar');
const close = document.querySelectorAll('.close');
const close2 = document.querySelectorAll('.close2');
const nav = document.querySelectorAll('.navbar');
const nav2 = document.querySelectorAll('.navbar2');

if (bar) {
    bar.addEventListener('click', () => {
        nav.forEach((element)=> element.classList.add('active'));
    })
}

if (close) {
    // close.addEventListener('click', () => {
    //     nav.forEach((element)=> element.classList.remove('active'));
    // })
    close.forEach((element)=> {
        element.addEventListener('click', ()=> {
            nav.forEach((element)=> element.classList.remove('active'));
        })
    })
}

if (bar) {
    bar.addEventListener('click', () => {
        nav2.forEach((element)=> element.classList.add('active'));
    })
}

if (close2) {
    // close.addEventListener('click', () => {
    //     nav.forEach((element)=> element.classList.remove('active'));
    // })
    close2.forEach((element)=> {
        element.addEventListener('click', ()=> {
            nav2.forEach((element)=> element.classList.remove('active'));
        })
    })
}

