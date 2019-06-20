
/* loader */
$(window).on('load', function() {
    $('.loader').fadeOut();
    $('.page-loader').delay(350).fadeOut('slow');
});

/* home scroll */
$("main").prev("header").addClass("trans");
$(window).on("scroll", function () {
    $("main").prev("header").css({"background-color":$(this).scrollTop() > 0 ? "rgba(47, 54, 64, 1)" : "rgba(47, 54, 64, 0)"});
}).trigger("scroll");

/* home banner */
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

/* adopt */
$("#dog_filters").ready(function () {
    $(this).on("change", "select", function () {
        var qs = JSON.parse($("#dog_filters").attr("filters"));
        qs[$(this).attr("name_")] = $(this).val();
        var filters = [];
        for (filter in qs) {
            filters.push(filter + "__" + qs[filter]);
        }
        window.location.href = $("#dog_filters").attr("action") + "?filters=" + filters.join(";");
    });
});

/* contact */
$("#captchaWrapper>a").on("click", function(e){
    e.preventDefault();
    var url = $("#captcha").attr("url");
    var querystring = Math.round(Math.random()*10000);
    $('#captcha').attr('src',url+'?'+querystring);
});
