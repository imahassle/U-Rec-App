function checkError(error) {
  if(!error) {
    console.log("No errors to report");
    return;
  }
  else {
    console.log("There were errors! Now reporting...");
    // console.log("Error code:", error.code);
    // console.log("HTTP Code:", error.http_code);
    console.log("Message:", error.error);
    var template = _.template($("#error-report-template").html());
    $("#error-report").html(template({message: error.error}));
    if($("#error-report").is(":hidden")) {
      $("#error-report").slideToggle();
    }

  }

}
