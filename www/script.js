document.addEventListener('DOMContentLoaded', function() {
    let carouselItems = document.querySelectorAll('.carousel-item');
    let currentIndex = 0;
   
    function changeSlide() {
       carouselItems[currentIndex].classList.remove('active');
       currentIndex = (currentIndex + 1) % carouselItems.length;
       carouselItems[currentIndex].classList.add('active');
    }
   
    // Change slide every 3 seconds
    setInterval(changeSlide, 3000);
   });
   