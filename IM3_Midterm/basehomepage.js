document.addEventListener('DOMContentLoaded', function() {
    const introButton = document.querySelector('.intro-button');
    const introContent = document.querySelector('.intro-content'); 

    introButton.addEventListener('click', function() {
        introContent.classList.toggle('active');
        introButton.classList.toggle('active');
    });


    const referButton = document.querySelector('.refer-button');
    const referContent = document.querySelector('.refer-content');

    referButton.addEventListener('click', function() {
        referContent.classList.toggle('active');
        referButton.classList.toggle('active');
    });
});