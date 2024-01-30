const btnPlus = document.querySelector('.btnPlus');
const plusInfo = document.querySelector('.plusInfo');
const affichePlusInfo = document.querySelector('.affichePlusInfo');
const btnMasquerPlusInfo = document.querySelector('.btnMasquerPlusInfo');

btnPlus.addEventListener('click', function() {
    plusInfo.classList.add('affichePlusInfo');
});

btnMasquerPlusInfo.addEventListener('click', function() {
    plusInfo.classList.remove('affichePlusInfo');
});

const printBtnA = document.getElementById('printBtnA');

printBtnA.addEventListener('click', function(){
    print();
});