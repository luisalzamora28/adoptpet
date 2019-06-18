$("#captchaWrapper>a").on("click", function(e){
    e.preventDefault();
    var url = $("#captcha").attr("url");
    var querystring = Math.round(Math.random()*10000);
    $('#captcha').attr('src',url+'?'+querystring);
});