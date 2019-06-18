/*Scroll*/
$("header").addClass("trans");
$(window).on("scroll", function () {
    $("header").css({"background-color":$(this).scrollTop() > 0 ? "rgba(47, 54, 64, 1)" : "rgba(47, 54, 64, 0)"});
}).trigger("scroll");
/*Banner*/
$("#slider").slick({
    arrows : false,
    infinite : true,
    fade: true,
    dots : false,
    autoplay : true,
    slidesToShow : 1,
    speed : 2000,
    pauseOnHover: false
});
