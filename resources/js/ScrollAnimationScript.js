document.addEventListener('keydown', function(event){

    if(event.keyCode == 38)
    {
        let frontImage = document.querySelector(".frontIMG");
        let backImage = document.querySelector(".fadeObject");
        //frontImage.style.display = 'none';
        frontImage.classList.toggle('transition');
        backImage.classList.toggle('transition');

    }
} );
