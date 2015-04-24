$("#logout-button").on('click', function() {
  console.log("Logging you on out...");
  $.removeCookie('U-Rex-API-Key');
  $.ajaxSetup();
  console.log($.cookie('U-Rex-API-Key'));
});
