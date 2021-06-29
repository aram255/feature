$(".toggle-password").click(function () {

   $(this).toggleClass("fa-eye fa-eye-slash");
   let input = $($(this).attr("toggle"));
   if (input.attr("type") == "password") {
      input.attr("type", "text");
   } else {
      input.attr("type", "password");
   }
});

$(".lg-sg__forgot-pass").click(function () {
   $(".lg-sg__form").css("display", "none");
   $(".forgot-pass").css("display", "inline");
});
$(".lg-sg__forgot-back").click(function () {
   $(".lg-sg__form").css("display", "inline");
   $(".forgot-pass").css("display", "none");
   $(".change-pass").css("display", "none");
});
$(".reset-pass").click(function () {
   $(".forgot-pass").css("display", "none");
   $(".change-pass").css("display", "inline");
});