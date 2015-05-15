function catchError(jqXHR, textStatus, errorThrown) {
  console.log(textStatus);
  checkError(textStatus);
};

$(document).ajaxError(catchError);

function checkError(error) {
  if(!error) {
    console.log("No errors to report");
    return;
  }
  else {
    console.log("There were errors! Now reporting...");
    // console.log("Error code:", error.code);
    // console.log("HTTP Code:", error.http_code);
    console.log("Error:", error.responseText);
    var template = _.template($("#error-report-template").html());
    $("#error-report").html(template({error: error}));
    if($("#error-report").is(":hidden")) {
      $("#error-report").slideToggle();
    }

  }

};
