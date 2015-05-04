$("#logout-button").on('click', function() {
  console.log("Logging you on out...");
  $.removeCookie('U-Rex-API-Key');
  app.viewsFactory.removeMenu();
  $.ajaxSetup({
    headers: { 'X-Authorization' : 'blank'}
  });
  console.log($.cookie('U-Rex-API-Key'));
  $(".aug-top-bar").hide();
});
