let signalerBtn = document.querySelector(".signalerErreur");
let errorBox = document.querySelector(".erreurBox");

signalerBtn.addEventListener('click', function(){
    signalerBtn.classList.add('hide');
    errorBox.classList.remove('hide');
})