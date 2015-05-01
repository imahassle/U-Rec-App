function checkError(error) {
  if(!error) {
    console.log("No errors to report");
    return;
  }
  else {
    console.log("There were errors! Now reporting...");
    console.log("Error code:", error.code);
    console.log("HTTP Code:", error.http_code);
    console.log("Message:", error.message);
  }

}
