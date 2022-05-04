// focus input tombol cari => memberikan sedikit bayangan putih saat hendak mengetik
const cari = document.getElementById("cari");
cari.addEventListener('focus', function(){
    cari.parentElement.classList.add('focus')
})
cari.addEventListener('focusout', function(){
    cari.parentElement.classList.remove('focus')
})


// humberger menu
const humbergerMenu = document.querySelector('header .humberger');
const menu = document.querySelector('header .menuHumberger');
const closeMenu = document.querySelector('header .closeMenu');
humbergerMenu.addEventListener('click', function(){
    menu.style.display='flex';
})
closeMenu.addEventListener('click', function(){
    menu.style.display='none';
})


// search responsive
// untuk memunculkan dan menghilangkan tombol cari saat web dibuka di tablet atau hp
const cariR = document.querySelector('header .cariR');
const inputCariR = document.querySelector('header #inputCariR')
const logoR = document.querySelector('header .logoR');
const closeMenuR = document.querySelector('header .closeMenuR');

cariR.addEventListener('click', function(){
    inputCariR.classList.remove('hide');
    inputCariR.parentElement.classList.remove('hide');
    logoR.classList.add('hide');
    cariR.classList.add('hide')
    closeMenuR.classList.remove('hide');
})
closeMenuR.addEventListener('click', function(){
    inputCariR.classList.add('hide');
    inputCariR.parentElement.classList.add('hide');
    logoR.classList.remove('hide');
    cariR.classList.remove('hide')
    closeMenuR.classList.add('hide');
})
inputCariR.addEventListener('focusout', function(){
    inputCariR.classList.toggle('hide');
    inputCariR.parentElement.classList.toggle('hide');
    logoR.classList.toggle('hide');
    closeMenuR.classList.add('hide');
    cariR.classList.remove('hide');
})



// overlay upload content
// untuk memunculkan overlay saat ingin upload content
const post = document.querySelectorAll(".write-content");
const overlay = document.querySelector(".overlay");
const closeOverlay = document.querySelector(".closeOverlay");
for(let i=0; i<post.length; i++){
    post[i].addEventListener("click", function(){
        overlay.classList.remove('hide');
    })
}
closeOverlay.addEventListener("click", function(){
    overlay.classList.add('hide');
})


// opsi postingan
// untuk memunculkan opsi edit atau hapus pada postingan yg ada
const opsi = document.querySelectorAll(".opsi");
const opsiAksi = document.querySelectorAll(".opsiAksi");
const tutupAksi = document.querySelectorAll(".tutupAksi");

for(let i=0; i<opsi.length; i++){
    opsi[i].addEventListener("click", function(){
        opsiAksi[i].classList.toggle('hide');
    })
    tutupAksi[i].addEventListener("click", function(){
        tutupAksi[i].parentElement.classList.toggle('hide');
        // console.log('OK')
    })
}
