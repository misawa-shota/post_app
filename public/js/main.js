// swiper
const mySwiper = new Swiper('.swiper', {
    loop: true,
    effect: "fade",
    speed: 2000,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
});

// 店舗詳細のタブ切り替え
const navInfo = document.getElementById('nav_infomation');
const navReview = document.getElementById('nav_review');
const areaInfo = document.getElementById('area_infomation');
const areaReview = document.getElementById('area_review');

navInfo.addEventListener('click', function() {
    this.classList.add('active');
    areaInfo.classList.add('active');
    this.nextElementSibling.classList.remove('active');
    areaReview.classList.remove('active');
});

navReview.addEventListener('click', function() {
    this.classList.add('active');
    areaInfo.classList.remove('active');
    this.previousElementSibling.classList.remove('active');
    areaReview.classList.add('active');
});

