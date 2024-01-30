const btnAjouter = document.querySelector('.btnAjouter');
const frameCreation = document.querySelector('.frameCreation');


btnAjouter.addEventListener ('click', function(){
    frameCreation.classList.add('afficheFrameCreation');
});

const btnCancel = document.querySelector('.btnCancel') ;

btnCancel.addEventListener('click', function(){
    frameCreation.classList.remove('afficheFrameCreation');
});
