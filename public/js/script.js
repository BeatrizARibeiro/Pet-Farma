const bar = document.getElementById('bar');
const close = document.querySelectorAll('.close');
const nav = document.querySelectorAll('.navbar');

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

