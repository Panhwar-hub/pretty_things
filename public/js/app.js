// Products Details Slider
$(".product-single-slider").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: ".product-list-slider",
});
$(".product-list-slider").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: ".product-single-slider",
  dots: false,
  focusOnSelect: true,
});

// Header Nav Slider
$(".headerNavSlider").slick({
  autoplay: true,
  autoplaySpeed: 2000,
  slidesToShow: 7,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
});

// Banner Slider
$(".bannerSlider").slick({
  autoplay: true,
  autoplaySpeed: 2000,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  dots: true,
});

// Deals Slider
$('.dealsSingle').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: false,
  asNavFor: '.dealsGallery'
});
$('.dealsGallery').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  vertical: true,
  asNavFor: '.dealsSingle',
  dots: true,
  arrows: false,
  focusOnSelect: true
});
// Reviews Single
// $(".reviews-single").slick({
//   autoplay: true,
//   autoplaySpeed: 3000,
//   slidesToShow: 1,
//   slidesToScroll: 1,
//   arrows: true,
//   dots: false,
// });
// Quantity Counter
const add = document.getElementById("add")
const quantity = document.getElementById("quantity")
var quantityNum = 0
const minus = document.getElementById("minus")
add.addEventListener("click", () => {
  quantityNum += 1
  quantity.value = quantityNum
  minus.style.pointerEvents = "all"
})
minus.addEventListener("click", () => {
  quantityNum -= 1
  quantity.value = quantityNum
  if (quantityNum==0){
    minus.style.pointerEvents = "none"
  }
  else{
    minus.style.pointerEvents = "all"
  }
})

// Password Show Hide Function
const passsordInput = document.getElementById("passwordInput");
const passwordLabel = document.querySelector(".showPassword");

function showHide() {
  if (passsordInput.type == "password") {
    passsordInput.type = "text";
  } else {
    passsordInput.type = "password";
  }
  passwordLabel.classList.toggle("show");
}

// Initialize Wow
new WOW().init();



