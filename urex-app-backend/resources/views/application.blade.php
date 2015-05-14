<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="U Rec CMS">

    <title>U Rec &ndash; CMS</title>

<link rel="stylesheet" href="css/featherlight.css">

<link rel="stylesheet" href="css/jquery.datetimepicker.css">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css">

<link rel="stylesheet" href="css/pure-release-0.6.0/pure-min.css">

    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="css/pure-release-0.6.0/side-menu.css">
    <!--<![endif]-->

<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

<!-- === Main Content === -->

<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="error-report" style="display: none"></div>

    <div class="header aug-top-bar" style="display: none">
        <label for="logout-button">Hello, <span id="userName">USER</span></label>
        <a id="logout-button" href="#login">Log out</a>
    </div>

    <div id="menu"></div>

    <div id="insert">
      <!-- Insert content here -->
    </div>
    <!-- Ignore below -->

</div>

<!-- === Views === -->

<!-- <script type="text/template" id="loading"></script> -->

<script type="text/template" id="error-report-template">
  <p class="error-type">Error:</p>
  <p class="error-text"><%= message %></p>
  <a id="error-close"><i class="fa fa-times right"></i></a>
  <script type="text/javascript">
  $("#error-close").on("click", function() {
    $("#error-report").slideToggle();
  });
  </script>
</script>

<script type="text/template" id="login">
  <div class="content login-view">
    <form id="login-form" class="pure-form pure-form-stacked">
      <h3>Login to the U-Rec App CMS</h3>
      <input id="usernameField" name="username" type="text">
      <input id="passwordField" name="password" type="password">
      <input type="submit" class="pure-button red pure-button-main">
    </form>
  </div>
  <script type="text/javascript">
  $('#login-form').submit(function(event) {
    console.log("Logging in...");
    event.preventDefault();
    var data = {
      username: $("#usernameField").val(),
      password: $("#passwordField").val()
    };
    $.ajax({
      url: "api/login",
      method: "POST",
      data: data
    }).done(function(data) {
      // console.log("response: ", data);
      console.log(data);
      $.cookie('U-Rex-API-Key', data.api_key);
      $.cookie('First-Name', data.first_name);
      $.cookie('Permissions', data.category_id);
      console.log($.cookie('U-Rex-API-Key'));
      $.ajaxSetup({
        headers: { 'X-Authorization' : $.cookie('U-Rex-API-Key')}
      });
      $("#userName").html(data.first_name);
      app.viewsFactory.menu();
      $(".aug-top-bar").show();
      app.changeContent(app.viewsFactory.home());
    });
  });
  </script>
</script>

<script type="text/template" id="editAnnouncement">
  <form action="javascript:" class="editAnnouncement" value="<%= model.id %>" class="pure-form pure-form-stacked">
    <input type="submit" class="pure-button pure-button-primary right red" value="SAVE">
    <input name="title" type="text" placeholder="Program Title" value="<%=model.title%>">
    <textarea name="message" id="programDetails" cols="62" rows="2" placeholder="Details" value=""><%=model.message%></textarea>
  </form>
  <script type="text/javascript">
  var collection = <%=coll%>;
  $(".editAnnouncement").on("submit", function() {
    console.log("saving changes...");
    var ID = $(this).attr("value");
    // console.log(ID);
    var data = {
      title: $(".editAnnouncement input[name=title]").val(),
      message: $(".editAnnouncement textarea[name=message]").val(),
      category_id: collection.get(ID).attributes.category_id
    };
    console.log(data);
    // collection.get(ID).set(data);
    // collection.get(ID).sync("UPDATE", collection.get(ID), {url:"api/announcement/"+ID}).done(function(error) {
    //   // checkError(error);
    // collection.fetch();
    // });
    collection.get(ID).save(data, {url:"api/announcement/"+ID});
  });
  </script>
</script>

<script type="text/template" id="homeTemplate">
<div class="header aug-header">
    <h1><%=name%> Home</h1>
</div>
    <div class="content home-view pure-g">
        <!-- Welcome Banner and Post form -->
        <div class="home-channel pure-u-3-5">
            <div class="home-main-banner">
                <h3 class="banner">Announcements</h3>
                <form action="javascript:" id="announcement-form" class="pure-form pure-form-stacked">
                    <h4>New Announcement</h4>
                    <button type="submit" class="pure-button pure-button-primary right red">POST</button>
                    <input name="title" type="text" placeholder="Program Title">
                    <textarea name="message" id="programDetails" cols="62" rows="2" placeholder="Details"></textarea>
                </form>
            </div>
            <!-- Announcement Template Below -->
            <% var count = Math.ceil(collection.length / 5);
               var isFirst = true;
               var index = 0; %>
            <% _(count).times(function() { %>
              <div class="set" <% if(!isFirst) { %> style="display: none" <% } %>>
                <% var c = 0; %>
                <% _.each(collection.slice(index, index+5), function(model) { %>
                  <div class="home-announcement" id="<%= model.id %>">
                      <a id="<%=model.id%>" class="removeAnnouncementButton"><i class="fa fa-trash fa-2x right red"></i></a>
                      <a class="editAnnouncementButton"><i class="fa fa-edit fa-2x right red"></i></a>
                      <p class="announcement-date"><%= model.date %></p>
                      <h4><%= model.title %></h4>
                      <p class="announcement-blurb"><%= model.message %></p>
                  </div>
                  <% c++; %>
                <% }); %>
                <p>Displaying <%=index+1%>-<%=index+c%> of <%=collection.length%></p>
                <% if((index + c) != collection.length) { %> <button class="center pure-button red showMore">Show More</button> <% } %>
              </div>
              <% index += 5;
              isFirst = false;  %>
            <% }); %>
        </div>
        <!-- Quick links menu here -->
        <%=menu%>
    </div>
    <script type="text/javascript">
      var collection = <%=coll%>;
      $('#announcement-form').on("submit", function(event) {
        event.preventDefault();
        var data = {
          title: $("#announcement-form > input[name='title']").val(),
          message: $("#announcement-form > textarea[name='message']").val(),
          category_id: <%=category%>,
          date: new Date().toString().split(" G")[0],
        };
        console.log(data);
        collection.create(data, {
          url: "api/announcement",
          wait: true,
          success: function() {
            console.log("refreshing view after submittal...");
            collection.fetch();
          }
        });
      });
      $(".editAnnouncementButton").on('click', function() {
        var id = $(this).parent(".home-announcement").attr("id");
        var parent = $(this).parent(".home-announcement");
        var template = _.template($("#editAnnouncement").html())
        console.log("Now editing announcement", id);
        $(parent).html(template({model: collection.get(id).attributes, coll: "<%=coll%>"}));
      });
      $(".removeAnnouncementButton").on('click', function() {
        console.log("Removing announcement", $(this).attr('id'));
        var id = $(this).attr('id');
        collection.get(id).destroy({url:"api/announcement/"+id});
      });
      $(".showMore").on("click", function() {
        $("#insert").find(".set:hidden").not("script").first().show();
        $(this).hide();
      });
    </script>
</script>

<script type="text/template" id="facilityMenu">
  <div class="pure-u-2-5 quick-menu">
    <a href="#facility/hours"><div class="quick-item"><i class="fa fa-clock-o fa-3x"></i><h3>Facility Hours</h3></div></a>
    <a href="#facility/programs"><div class="quick-item"><i class="fa fa-thumbs-o-up fa-3x"></i><h3>Incentive Programs</h3></div></a>
    <a href="#facility/events"><div class="quick-item"><i class="fa fa-calendar fa-3x"></i><h3>Events</h3></div></a>
    <a href="#facility/photos"><div class="quick-item"><i class="fa fa-picture-o fa-3x"></i><h3>Photos</h3></div></a>
    <a href="#facility/feedback"><div class="quick-item"><i class="fa fa-comments fa-3x"></i><h3>View Feedback</h3></div></a>
    <a href="#"><div class="quick-item"><i class="fa fa-facebook fa-3x"></i><h3>Facebook</h3></div></a>
  </div>
</script>

<script type="text/template" id="outdoorrecMenu">
  <div class="pure-u-2-5 quick-menu">
    <a href="#outdoorrec/trips"><div class="quick-item"><i class="fa fa-bus fa-3x"></i><h3>Trips</h3></div></a>
    <a href="#outdoorrec/photos"><div class="quick-item"><i class="fa fa-picture-o fa-3x"></i><h3>Photos</h3></div></a>
    <a href="#"><div class="quick-item"><i class="fa fa-facebook fa-3x"></i><h3>Facebook</h3></div></a>
  </div>
</script>

<script type="text/template" id="intramuralsMenu">
  <div class="pure-u-2-5 quick-menu">
    <a href="#outdoorrec/photos"><div class="quick-item"><i class="fa fa-picture-o fa-3x"></i><h3>Photos</h3></div></a>
    <a href="#outdoorrec/trips"><div class="quick-item"><i class="fa fa-futbol-o fa-3x"></i><h3>IMLeagues</h3></div></a>
    <a href="#"><div class="quick-item"><i class="fa fa-twitter fa-3x"></i><h3>Twitter</h3></div></a>
  </div>
</script>

<script type="text/template" id="climbingwallMenu">
  <div class="pure-u-2-5 quick-menu">
    <a href="#climbingwall/hours"><div class="quick-item"><i class="fa fa-clock-o fa-3x"></i><h3>Hours</h3></div></a>
    <a href="#climbingwall/photos"><div class="quick-item"><i class="fa fa-picture-o fa-3x"></i><h3>Photos</h3></div></a>
    <a href="#climbingwall/events"><div class="quick-item"><i class="fa fa-calendar fa-3x"></i><h3>Climb Events</h3></div></a>
    <a href="#"><div class="quick-item"><i class="fa fa-twitter fa-3x"></i><h3>Twitter</h3></div></a>
    <a href="#"><div class="quick-item"><i class="fa fa-facebook fa-3x"></i><h3>Facebook</h3></div></a>
  </div>
</script>

<script type="text/template" id="facilityFeedback">
  <div class="header aug-header">
    <h1>Feedback</h1>
  </div>
  <div>
    <% var count = Math.ceil(collection.length / 5);
       var isFirst = true;
       var index = 0; %>
    <% _(count).times(function() { %>
      <div class="set content" <% if(!isFirst) { %> style="display: none" <% } %>>
        <% var c = 0; %>
        <% _.each(esceptionsCollection.slice(index, index+5), function(model) { %>
          <div class="creation">
            <button id="<%=model.id%>" class="feedbackDelete pure-button red right">Delete</button>
            <p><b class="red">From:</b> <%=model.email%></p>
            <p><b class="red">Submitted:</b> <%=model.date%></p>
            <p><%= model.message %></p>
          </div>
          <% c++; %>
        <% }); %>
        <p>Displaying <%=index+1%>-<%=index+c%> of <%=collection.length%></p>
        <% if((index + c) != collection.length) { %> <button class="center pure-button red showMore">Show More</button> <% } %>
      </div>
      <% index += 5;
      isFirst = false;  %>
    <% }); %>
  </div>
  <script type="text/javascript">
    $(".showMore").on("click", function() {
      $("#insert").find(".set:hidden").not("script").first().show();
      $(this).hide();
    });
    var collection = <%=coll%>;
    $(".feedbackDelete").on('click', function() {
      console.log("Removing event", $(this).attr('id'));
      var id = $(this).attr('id');
      collection.get(id).destroy({url:"api/feedback/"+id});
    });
  </script>
</script>

<script type="text/template" id="imageTemplate">
  <div class="header aug-header">
      <h1><%=name%> Photos</h1>
  </div>
  <div class="content">
    <div class="creation">
      <form action="javascript:" id="photoUpload" class="pure-form pure-form-stacked">
        <input id="fileUpload" type="file" value="Upload Photos">
        <br>
        <fieldset>
          <input class="pure-input" type="text" placeholder="Caption">
          <button class="pure-button red imageSubmit">SUBMIT</button>
        </fieldset>
      </form>
    </div>
  </div>
  <div class="content pure-g photos-view">
          <div class="pure-g">
              <% _.each(collection.toJSON(), function(model) { %>
                <div class="pure-u-1-4">
                <i id="<%=model.id%>" class="fa fa-times red deletePhoto"></i>
                  <a data-featherlight="#image-<%= model.id %>"><img id="image-<%= model.id %>" src="<%= model.file_location %>" title="<%= model.caption %>"></a>
                  <p><%= model.caption %></p>
                  </div>
              <% }); %>
          </div>
  </div>
  <script type="text/javascript">
  var collection = <%=coll%>;
    $("#photoUpload input[type=file]").on("change", function() {
      console.log(this.files[0]);
    });
    $(".deletePhoto").on('click', function() {
      collection.get($(this).attr('id')).destroy({url:"api/image/"+$(this).attr('id')});
    });
    $("#photoUpload .imageSubmit").on("click", function() {
      var theFile = $("#fileUpload")[0].files[0];
      if(typeof theFile == "undefined") {
        checkError({message: "Please select an image!"});
      }
      else if (theFile.size > 5242880) {
        checkError({error: "Your file size is too big! Try uploading a smaller image."});
      }
      else {
        var reader = new FileReader();
        var fileExt = null;
        var fileData = null;
        var size = theFile.size;

        fileExt = theFile.name.split('.').pop();
        reader.readAsDataURL(theFile);
        reader.onload = function(file) {
          fileData = file.target.result;

          var image = {
            file: fileData,
            caption: $("#photoUpload input[type=text]").val(),
            extension: fileExt,
            category_id: <%=cat%>,
          };

          collection.create(image, {
            url: "api/image",
            wait: true,
            success: function() {
              console.log("Successfully uploaded image");
            }
          });
        };
      }
    });
  </script>
</script>

<script type="text/template" id="hoursTemplate">
  <div class="header aug-header">
          <h1><%=name%> Hours</h1>
      </div>
      <div class="content">
        <% _.each(collection, function(model) { %>
          <div class="creation">
            <button id="<%=model.id%>" class="hoursDelete pure-button red right">Delete</button>
            <p><b class="red"><%=model.day_of_week%></b><%=model.open%> - <%=model.close%></p>
          </div>
        <% }); %>
      </div>
      <div class="content">
          <div class="creation">
              <h3>Set the standard open hours for the facility:</h3>
              <form class="pure-form pure-form-aligned" id="hoursForm">
                <div class="buttons-group">
                    <button type="submit" class="pure-button pure-button-primary right red">Create Hours Rule</button>
                </div>
                <div class="pure-control-group">
                    <select id="daySelect">
                      <option value="Monday">Monday</option>
                      <option value="Tuesday">Tuesday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Thursday">Thursday</option>
                      <option value="Friday">Friday</option>
                      <option value="Saturday">Saturday</option>
                      <option value="Sunday">Sunday</option>
                    </select>
                    <input id="startTime" class="pure-u-1-5" type="text">
                    <label class="secondLabel">to</label>
                    <input id="endTime" class="pure-u-1-5" type="text">
                </div>
                <br>
              </form>
          </div>
      </div>
      <div class="content">
        <div class="creation">
          <form>
            <div class="pure-control-group">
              <label>Exception:</label>
              <label for="one1"><input id="one1" name="exception" type="radio" value="one">One Day</label>
              <label for="multi1"><input id="multi1" name="exception" type="radio" value="multi">Multiple Days</label>
              <i class="fa fa-times-circle fa-lg"></i>
            </div>
            <div class="pure-control-group">
                <label for="startTime">from this date</label>
                <input id="startTime" class="pure-u-1-5" type="date">
                <label class="secondLabel">to</label>
                <input class="pure-u-1-5" type="date">
            </div>
            <div class="pure-control-group">
              <label for="startTime">at this time</label>
              <input id="startTime" class="pure-u-1-5" type="time">
              <label class="secondLabel">to</label>
              <input class="pure-u-1-5" type="time">
            </div>
            <br>
            <div class="pure-control-group">
              <button class="pure-button">Add Exception</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Exceptions template -->
      <% var count = Math.ceil(collection.length / 5);
         var isFirst = true;
         var index = 0; %>
      <% _(count).times(function() { %>
        <div class="set content" <% if(!isFirst) { %> style="display: none" <% } %>>
          <% var c = 0; %>
          <% _.each(collection.toJSON().slice(index, index+5), function(model) { %>
            <div class="creation">
              <button id="<%=model.id%>" class="feedbackDelete pure-button red right">Delete</button>
              <p><b class="red">From:</b> <%=model.email%></p>
              <p><b class="red">Submitted:</b> <%=model.date%></p>
              <p><%= model.message %></p>
            </div>
            <% c++; %>
          <% }); %>
          <p>Displaying <%=index+1%>-<%=index+c%> of <%=collection.length%></p>
          <% if((index + c) != collection.length) { %> <button class="center pure-button red showMore">Show More</button> <% } %>
        </div>
        <% index += 5;
        isFirst = false;  %>
      <% }); %>
      <script type="text/javascript">
        $("#startTime").datetimepicker({datepicker: false, format:"h:i A", formatTime: "h:i A", step:30});
        $("#endTime").datetimepicker({datepicker: false, format:"h:i A", formatTime: "h:i A", step:30});
        $("#hoursForm").submit(function(event) {
          event.preventDefault();
          var data = {
            day_of_week: $("#hoursForm #daySelect>option:selected").val(),
            category: <%=category%>,
            open: $("#hoursForm #startTime").val(),
            close: $("#hoursForm #endTime").val(),
          };
          console.log(data);
        });
      </script>
</script>

<script type="text/template" id="editProgram">
  <form class="editProgram pure-form pure-form-stacked" value="<%= model.id %>" action="javascript:">
    <% if(model.image != null) { %>
      <img src="<%=model.image%>">
    <% } %>

    <input type="text" name="title" value="<%= model.title %>" >
    <div class="clearfix"></div>
    <div class="buttons-group">
      <input type="submit" class="pure-button red" value="Save">
    </div>
    <div class="clearfix"></div>
    <textarea style="width: 100%" name="message"><%= model.description %></textarea>
    <% if(model.image != null) { %>
      <p>Images may be removed at the Photos page. If you need to change the photo, delete this event and create a new one.</p>
    <% } %>
  </form>

    <script type="text/javascript">
    $(".editProgram").on("submit", function() {
      console.log("saving changes...");
      var ID = $(this).attr("value");
      // console.log(ID);
      var data = new Announcement({
        id: ID,
        title: $(this).children("input[name=title]").val(),
        description: $(this).children("textarea[name=message]").val(),
      });
      app.viewsFactory.facilityProg().collection.get(ID).sync("update", data, {url:"api/incentive_program/"+ID}).done(function() {
        app.viewsFactory.facilityProg().collection.fetch();
      });
    });
    </script>
</script>

<script type="text/template" id="programTemplate">
  <div class="header aug-header">
      <h1>Incentive Programs</h1>
  </div>
  <div class="content">
      <div class="creation">
          <h3>Create a New Incentive Program</h3>
          <form id="eventForm" class="pure-form pure-form-aligned">
              <div class="pure-control-group">
              <input name="title" type="text" class="pure-u-1-3" placeholder="Program Title">
              </div>
              <div class="pure-control-group">
                <textarea name="" id="description" rows="4" class="pure-u-1" placeholder="Description"></textarea>
              </div>
              <div class="pure-control-group">
                  <label>Photo (optional)</label>
                  <input id="fileUpload" type="file">
              </div>
              <div class="right">
                  <input type="submit" class="pure-button red" value="Done">
              </div>
              <div class="clearfix"></div>
          </form>
      </div>
    </div>
      <!-- Announcement Template Below -->
      <% var count = Math.ceil(collection.length / 5);
         var isFirst = true;
         var index = 0; %>
      <% _(count).times(function() { %>
        <div class="set content" <% if(!isFirst) { %> style="display: none" <% } %>>
          <% var c = 0; %>
          <% _.each(collection.slice(index, index+5), function(model) { %>
              <div class="creation" id="<%=model.id%>">
                <% if(model.image != null) { %>
                  <img src="<%=model.image%>">
                <% } %>
                  <h4><%=model.title%> </h4>
                  <div class="buttons-group">
                      <i id="<%=model.id%>" class="fa fa-edit fa-2x icon-hover editEvent"></i>
                      <i id="<%=model.id%>" class="fa fa-trash fa-2x icon-hover removeEvent"></i>
                  </div>
                  <p><%=model.description%> </p>
                  <div class="clearfix"></div>
              </div>
            <% c++; %>
          <% }); %>
          <p>Displaying <%=index+1%>-<%=index+c%> of <%=collection.length%></p>
          <% if((index + c) != collection.length) { %> <button class="center pure-button red showMore">Show More</button> <% } %>
        </div>
        <% index += 5;
        isFirst = false;  %>
      <% }); %>
  <script type="text/javascript">
  $("#startDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
  $("#endDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
  var submitEvent = function(imageData) {
    var collection = <%=coll%>;
    var data = {
      title: $("#eventForm input[name='title']").val(),
      description: $("#eventForm #description").val(),
      image: imageData
    };
    console.log(data);
    collection.create(data, {
      url: "api/incentive_program",
      wait: true,
      success: function(response) {
        console.log("refreshing view after submittal...");
        collection.fetch();
      }
    });
  };
  var collection = <%=coll%>;
  $('#eventForm').on("submit", function(event) {
    event.preventDefault();
    var theFile = $("#fileUpload")[0].files[0];
    var size = 0;
    var noFile = true;
    var imageData = {};
    if(typeof theFile != "undefined") {
      size = theFile.size;
      noFile = false;
    }
    if (size > 5242880) {
      checkError({error: "Your file size is too big! Try uploading a smaller image."});
    }
    else if(!noFile) {
      // Upload the file and associate it with the event
      var reader = new FileReader();
      var fileExt = null;
      var fileData = null;
      var size = theFile.size;

      fileExt = theFile.name.split('.').pop();
      reader.readAsDataURL(theFile);
      reader.onload = function(file) {
        fileData = file.target.result;

        var imageData = {
          file: fileData,
          extension: fileExt,
        };
        submitEvent(imageData);
      }
    }
    else { //Otherwise simply create event
      submitEvent(imageData);
    }
  });
  $(".editEvent").on('click', function() {
    var id = $(this).attr("id");
    var parent = $(this).parent().parent(".creation");
    var template = _.template($("#editProgram").html());
    console.log("Now editing event", id);
    $(parent).html(template({model: collection.get(id).attributes, coll: "<%=coll%>"}));
  });
  $(".removeEvent").on('click', function() {
    console.log("Removing event", $(this).attr('id'));
    var id = $(this).attr('id');
    collection.get(id).destroy({url:"api/event/"+id});
  });
  $(".showMore").on("click", function() {
    $("#insert").find(".set:hidden").not("script").first().show();
    $(this).hide();
  });
  </script>
</script>

<script type="text/template" id="editEvent">
  <div class="">
  <form class="editEvent" value="<%= model.id %>" class="pure-form pure-form-aligned">
    <% if(model.image != null) { %>
      <img src="<%=model.image%>">
    <% } %>
    <div class="pure-control-group">
      <input name="editTitle" type="text" class="pure-u-1-3" placeholder="Event Title" value="<%=model.title%>">
    </div>
    <div class="pure-control-group">
        <label class="firstLabel" for="editStartTime">Starts at</label>
        <input id="editStartDate" type="text" value="<%-model.start%>">
    </div>
    <div class="pure-control-group">
        <label class="firstLabel" for="editEndTime">Ends at</label>
        <input id="editEndDate" type="text" value="<%-model.end%>">
    </div>
    <div class="pure-control-group">
      <textarea name="" id="description" rows="4" class="pure-u-1" placeholder="Details"><%=model.description%></textarea>
    </div>
    <input type="submit" class="pure-button pure-button-primary right red" value="SAVE">
    <% if(model.image != null) { %>
      <p>Images may be removed at the Photos page. If you need to change the photo, delete this event and create a new one.</p>
    <% } %>
    <div class="clearfix"></div>
  </form>
</div>
  <script type="text/javascript">
  $("#editStartDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
  $("#editEndDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
  var collection = <%=coll%>;
  $(".editEvent").on("submit", function(event) {
    event.preventDefault();
    console.log("saving changes...");
    var ID = $(this).attr("value");
    // console.log(ID);
    var data = {
      title: $(".editEvent input[name=editTitle]").val(),
      description: $(".editEvent #description").val(),
      start: $(".editEvent #editStartDate").val(),
      end: $(".editEvent #editEndDate").val(),
      // category_id: collection.get(ID).attributes.category_id
    };
    console.log(data);
    collection.get(ID).set(data);
    collection.get(ID).sync("UPDATE", collection.get(ID), {url:"api/event/"+ID}).done(function(error) {
      // checkError(error);
    // collection.fetch();
    });
    collection.get(ID).save(data, {url:"api/event/"+ID});
  });
  </script>
</script>

<script type="text/template" id="eventTemplate">
    <div class="header aug-header">
        <h1><%=name%> Events</h1>
    </div>
    <div class="content">
        <div class="creation">
            <h3>Create a New Event</h3>
            <form id="eventForm" class="pure-form pure-form-aligned">
                <div class="pure-control-group">
                <input name="title" type="text" class="pure-u-1-3" placeholder="Event Title">
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel" for="startTime">Starts at</label>
                    <input id="startDate" type="text">
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel" for="endTime">Ends at</label>
                    <input id="endDate" type="text">
                </div>
                <div class="pure-control-group">
                  <textarea name="" id="description" rows="4" class="pure-u-1" placeholder="Details"></textarea>
                </div>
                <div class="pure-control-group">
                    <label>Photo (optional)</label>
                    <input id="fileUpload" type="file">
                </div>
                <div class="right">
                    <input type="submit" class="pure-button red" value="Done">
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
      </div>
        <!-- Announcement Template Below -->
        <% var count = Math.ceil(collection.length / 5);
           var isFirst = true;
           var index = 0; %>
        <% _(count).times(function() { %>
          <div class="set content" <% if(!isFirst) { %> style="display: none" <% } %>>
            <% var c = 0; %>
            <% _.each(collection.slice(index, index+5), function(model) { %>
                <div class="creation" id="<%=model.id%>">
                  <% if(model.image != null) { %>
                    <img src="<%=model.image%>">
                  <% } %>
                    <h4><%=model.title%> </h4>
                    <h5><%=model.start%> - <%=model.end%> </h5>
                    <div class="buttons-group">
                        <i id="<%=model.id%>" class="fa fa-edit fa-2x icon-hover editEvent"></i>
                        <i id="<%=model.id%>" class="fa fa-trash fa-2x icon-hover removeEvent"></i>
                    </div>
                    <p><%=model.description%> </p>
                    <div class="clearfix"></div>
                </div>
              <% c++; %>
            <% }); %>
            <p>Displaying <%=index+1%>-<%=index+c%> of <%=collection.length%></p>
            <% if((index + c) != collection.length) { %> <button class="center pure-button red showMore">Show More</button> <% } %>
          </div>
          <% index += 5;
          isFirst = false;  %>
        <% }); %>
    <script type="text/javascript">
    $("#startDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
    $("#endDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
    var submitEvent = function(imageData) {
      var collection = <%=coll%>;
      var data = {
        title: $("#eventForm input[name='title']").val(),
        start: $("#startDate").val(),
        end: $("#endDate").val(),
        description: $("#eventForm #description").val(),
        cost: null,
        spots: null,
        gear_needed: null,
        category_id: <%=category%>,
        image: imageData
      };
      console.log(data);
      collection.create(data, {
        url: "api/event",
        wait: true,
        success: function(response) {
          // eventID = response.id;
          console.log("refreshing view after submittal...");
          collection.fetch();
        }
      });
      // console.log("New event id is " + eventID);
    };
    var collection = <%=coll%>;
    $('#eventForm').on("submit", function(event) {
      event.preventDefault();
      var theFile = $("#fileUpload")[0].files[0];
      var size = 0;
      var noFile = true;
      var imageData = {};
      if(typeof theFile != "undefined") {
        size = theFile.size;
        noFile = false;
      }
      if (size > 5242880) {
        checkError({error: "Your file size is too big! Try uploading a smaller image."});
      }
      else if(!noFile) {
        // Upload the file and associate it with the event
        var reader = new FileReader();
        var fileExt = null;
        var fileData = null;
        var size = theFile.size;

        fileExt = theFile.name.split('.').pop();
        reader.readAsDataURL(theFile);
        reader.onload = function(file) {
          fileData = file.target.result;

          var imageData = {
            file: fileData,
            extension: fileExt,
            category_id: <%=category%>,
          };
          submitEvent(imageData);
        }
      }
      else { //Otherwise simply create event
        submitEvent(imageData);
      }
    });
    $(".editEvent").on('click', function() {
      var id = $(this).attr("id");
      var parent = $(this).parent().parent(".creation");
      var template = _.template($("#editEvent").html());
      console.log("Now editing event", id);
      $(parent).html(template({model: collection.get(id).attributes, coll: "<%=coll%>"}));
    });
    $(".removeEvent").on('click', function() {
      console.log("Removing event", $(this).attr('id'));
      var id = $(this).attr('id');
      collection.get(id).destroy({url:"api/event/"+id});
    });
    $(".showMore").on("click", function() {
      $("#insert").find(".set:hidden").not("script").first().show();
      $(this).hide();
    });
    </script>
</script>

<script type="text/template" id="editTrip">
  <div class="">
  <form class="editEvent" value="<%= model.id %>" class="pure-form pure-form-aligned">
    <% if(model.image != null) { %>
      <img src="<%=model.image%>">
    <% } %>
    <div class="pure-control-group">
      <input name="editTitle" type="text" class="pure-u-1-3" placeholder="Event Title" value="<%=model.title%>">
    </div>
    <div class="pure-control-group">
        <label class="firstLabel" for="editStartTime">Starts at</label>
        <input id="editStartDate" class="pure-u-1-5" type="text" value="<%=model.start%>">
        <label class="">Price</label>
        <input id="editPrice" class="pure-u-1-12" type="number" value="<%=model.cost%>">
    </div>
    <div class="pure-control-group">
        <label class="firstLabel" for="endDate">Ends at</label>
        <input id="editEndDate" type="text" value="<%=model.end%>">
        <label class="">Spots</label>
        <input id="editSpots" class="pure-u-1-12" type="number" value="<%=model.spots%>">
    </div>
    <div class="pure-control-group">
    <input id="editGear" type="text" class="pure-u-1-2" value="<%=model.gear_needed%>">
    </div>
    <div class="pure-control-group">
      <textarea name="" id="description" rows="4" class="pure-u-1" placeholder="Details"><%=model.description%></textarea>
    </div>
    <input type="submit" class="pure-button pure-button-primary right red" value="SAVE">
    <% if(model.image != null) { %>
      <p>Images may be removed at the Photos page. If you need to change the photo, delete this event and create a new one.</p>
    <% } %>
    <div class="clearfix"></div>
  </form>
</div>
  <script type="text/javascript">
  $("#editStartDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
  $("#editEndDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
  var collection = <%=coll%>;
  $(".editEvent").on("submit", function(event) {
    event.preventDefault();
    console.log("saving changes...");
    var ID = $(this).attr("value");
    // console.log(ID);
    var data = {
      title: $(".editEvent input[name='editTitle']").val(),
      start: $("#editStartDate").val(),
      end: $("#editEndDate").val(),
      description: $(".editEvent #description").val(),
      cost: $("#editPrice").val(),
      spots: $("#editSpots").val(),
      gear_needed: $("#editGear").val()
    };
    console.log(data);
    collection.get(ID).set(data);
    collection.get(ID).sync("UPDATE", collection.get(ID), {url:"api/event/"+ID}).done(function(error) {
      // checkError(error);
    // collection.fetch();
    });
    collection.get(ID).save(data, {url:"api/event/"+ID});
  });
  </script>
</script>

<script type="text/template" id="tripTemplate">
    <div class="header aug-header">
        <h1><%=name%> Trips</h1>
    </div>
    <div class="content">
        <div class="creation">
          <h3>Create a New Trip</h3>
          <form class="pure-form pure-form-aligned" id="tripForm">
              <div class="pure-control-group">
                  <input type="text" name="title" class="pure-u-1-3" placeholder="Trip Title">
              </div>
              <div class="pure-control-group">
                  <label class="firstLabel" for="startTime">Starts at</label>
                  <input id="startDate" class="pure-u-1-5" type="text">
                  <label class="">Price</label>
                  <input id="price" class="pure-u-1-12" type="number">
              </div>
              <div class="pure-control-group">
                  <label class="firstLabel" for="endDate">Ends at</label>
                  <input id="endDate" type="text">
                  <label class="">Spots</label>
                  <input id="spots" class="pure-u-1-12" type="number">
              </div>
              <div class="pure-control-group">
              <input id="gear" type="text" class="pure-u-1-2" placeholder="Gear students need to bring">
              </div>
              <div class="pure-control-group">
              <textarea name="" id="description" rows="4" class="pure-u-1" placeholder="Details"></textarea>
              </div>
              <div class="pure-control-group">
                  <label>Photo (optional)</label>
                  <input id="fileUpload" type="file">
              </div>
              <div class="buttons-group">
                  <input type="submit" value="DONE" class="pure-button red">
              </div>
              <div class="clearfix"></div>
          </form>
        </div>
      </div>
        <!-- Announcement Template Below -->
        <% var count = Math.ceil(collection.length / 5);
           var isFirst = true;
           var index = 0; %>
        <% _(count).times(function() { %>
          <div class="set content" <% if(!isFirst) { %> style="display: none" <% } %>>
            <% var c = 0; %>
            <% _.each(collection.slice(index, index+5), function(model) { %>
                <div class="creation" id="<%=model.id%>">
                  <% if(model.image != null) { %>
                    <img src="<%=model.image%>">
                  <% } %>
                    <h4><%=model.title%> </h4>
                    <h5><%=model.start%> - <%=model.end%> </h5>
                    <% if(model.cost != 0) { %>
                      <h5>Price: $<%=model.cost%> </h5>
                    <% } %>
                    <% if(model.spots != 0) { %>
                      <h5>Spots: <%=model.spots%> </h5>
                    <% } %>
                    <% if((model.experience != null) && (model.experience != "")) { %>
                      <h5>Experience Needed: <%=model.experience%> </h5>
                    <% } %>
                    <% if((model.gear_needed != null) && (model.gear_needed != "")) { %>
                      <h5>Gear: <%=model.gear_needed%> </h5>
                    <% } %>
                    <div class="buttons-group">
                        <i id="<%=model.id%>" class="fa fa-edit fa-2x icon-hover editEvent"></i>
                        <i id="<%=model.id%>" class="fa fa-trash fa-2x icon-hover removeEvent"></i>
                    </div>
                    <p><%=model.description%> </p>
                    <div class="clearfix"></div>
                </div>
              <% c++; %>
            <% }); %>
            <p>Displaying <%=index+1%>-<%=index+c%> of <%=collection.length%></p>
            <% if((index + c) != collection.length) { %> <button class="center pure-button red showMore">Show More</button> <% } %>
          </div>
          <% index += 5;
          isFirst = false;  %>
        <% }); %>
    <script type="text/javascript">
    $("#startDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
    $("#endDate").datetimepicker({format: "m/d/Y h:iA", formatTime: "h:iA", step:30});
    var submitEvent = function(imageData) {
      var collection = <%=coll%>;
      var data = {
        title: $("#tripForm input[name='title']").val(),
        start: $("#startDate").val(),
        end: $("#endDate").val(),
        description: $("#tripForm #description").val(),
        cost: $("#price").val(),
        spots: $("#spots").val(),
        gear_needed: $("#gear").val(),
        category_id: <%=category%>,
        image: imageData
      };
      console.log(data);
      collection.create(data, {
        url: "api/event",
        wait: true,
        success: function(response) {
          // eventID = response.id;
          console.log("refreshing view after submittal...");
          collection.fetch();
        }
      });
      // console.log("New event id is " + eventID);
    };
    var collection = <%=coll%>;
    $('#tripForm').on("submit", function(event) {
      event.preventDefault();
      var theFile = $("#fileUpload")[0].files[0];
      var size = 0;
      var noFile = true;
      var imageData = {};
      if(typeof theFile != "undefined") {
        size = theFile.size;
        noFile = false;
      }
      if (size > 5242880) {
        checkError({error: "Your file size is too big! Try uploading a smaller image."});
      }
      else if(!noFile) {
        // Upload the file and associate it with the event
        var reader = new FileReader();
        var fileExt = null;
        var fileData = null;
        var size = theFile.size;

        fileExt = theFile.name.split('.').pop();
        reader.readAsDataURL(theFile);
        reader.onload = function(file) {
          fileData = file.target.result;

          var imageData = {
            file: fileData,
            extension: fileExt,
            category_id: <%=category%>,
          };
          submitEvent(imageData);
        }
      }
      else { //Otherwise simply create event
        submitEvent(imageData);
      }
    });
    $(".editEvent").on('click', function() {
      var id = $(this).attr("id");
      var parent = $(this).parent().parent(".creation");
      var template = _.template($("#editTrip").html());
      console.log("Now editing event", id);
      $(parent).html(template({model: collection.get(id).attributes, coll: "<%=coll%>"}));
    });
    $(".removeEvent").on('click', function() {
      console.log("Removing event", $(this).attr('id'));
      var id = $(this).attr('id');
      collection.get(id).destroy({url:"api/event/"+id});
    });
    $(".showMore").on("click", function() {
      $("#insert").find(".set:hidden").not("script").first().show();
      $(this).hide();
    });
    </script>
</script>

<script type="text/template" id="cms-menu">
<div class="pure-menu custom-restricted-width">
    <ul id="menu" class="pure-menu-list">
        <a class="pure-menu-heading" href="#">U Rec CMS</a>
        <div id="loading"></div>
        <div class="menu-space"></div>
        <% if(permissions==1) { %>
        <li class="pure-menu-item"><a href="#admin" class="pure-menu-link">Admin</a></li>
        <li class="pure-menu-item"><a href="#facility" class="pure-menu-link">Facility</a></li>
            <ul class="pure-menu-list">
                <li><a href="#facility/hours" class="pure-menu-link">Hours</a></li>
                <li><a href="#facility/programs" class="pure-menu-link">Incentive Programs</a></li>
                <li><a href="#facility/events" class="pure-menu-link">Events</a></li>
                <li><a href="#facility/photos" class="pure-menu-link">Photos</a></li>
                <li><a href="#facility/feedback" class="pure-menu-link">View feedback</a></li>
            </ul>
        <% } %>
        <% if(permissions==2 || permissions==1) { %>
        <li class="pure-menu-item"><a href="#outdoorrec"class="pure-menu-link">Outdoor Rec</a></li>
            <ul class="pure-menu-list">
                <li><a href="#outdoorrec/trips" class="pure-menu-link">Trips</a></li>
                <li><a href="#outdoorrec/photos" class="pure-menu-link">Photos</a></li>
            </ul>
        <% } %>
        <% if(permissions==3 || permissions==1) { %>
        <li class="pure-menu-item"><a href="#intramurals"class="pure-menu-link">Intramurals</a></li>
            <ul class="pure-menu-list">
                <li><a href="#intramurals/photos" class="pure-menu-link">Photos</a></li>
            </ul>
        <% } %>
        <% if(permissions==4 || permissions==1) { %>
        <li class="pure-menu-item"><a href="#climbingwall"class="pure-menu-link">Climbing Wall</a></li>
            <ul class="pure-menu-list">
                <li><a href="#climbingwall/hours" class="pure-menu-link">Hours</a></li>
                <li><a href="#climbingwall/photos" class="pure-menu-link">Photos</a></li>
                <li><a href="#climbingwall/events" class="pure-menu-link">Events</a></li>
            </ul>
        <% } %>
        <% if(permissions==2 || permissions==1) { %>
        <li class="pure-menu-item"><a href="#rentals" class="pure-menu-link">Rentals</a></li>
        <% } %>
    </ul>
</div>
</script>

<script type="text/template" id="admin">
  <div class="header aug-header">
      <h1>Admin</h1>
  </div>
</script>

<script type="text/template" id="rentalTemplate">
<div class="header aug-header">
    <h1>Rentals</h1>
</div>
<div class="content">
<div class="table-wrapper">
    <table class="pure-table aug-table">
    <thead>
        <th class="clear-head"></th>
        <th class="aug-th">Student Rates</th>
        <th class="aug-th">Faculty Rates</th>
    </thead>
</table>
    <table class="pure-table aug-table pure-table-horizontal">
        <thead>

            <tr>
                <th class="aug-tr-lead">Days</th>
                <th>1</th>
                <th>2-3</th>
                <th>4-6</th>
                <th>7-10</th>
                <th>1</th>
                <th>2-3</th>
                <th>4-6</th>
                <th>7-10</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <% _.each(collection, function(model) { %>
            <tr>
                <td class="aug-tr-lead" id="<%=model.id%>"><%=model.name%> </td>
                <td>$<%=model.student_pricing_1%> </td>
                <td>$<%=model.student_pricing_2%> </td>
                <td>$<%=model.student_pricing_3%> </td>
                <td>$<%=model.student_pricing_4%> </td>
                <td>$<%=model.faculty_pricing_1%> </td>
                <td>$<%=model.faculty_pricing_2%> </td>
                <td>$<%=model.faculty_pricing_3%> </td>
                <td>$<%=model.faculty_pricing_4%> </td>
                <td><i id="<%=model.id%>" class="fa fa-times removeRental red"></i></td>
            </tr>
          <% }) %>
        </tbody>
    </table>
  </div>
  <div class="content">
    <div class="creation">
      <h3>New Rental Item</h3>
      <form class="pure-form pure-form-aligned newRentalForm">
        <fieldset>
          <input type="text" name="title" placeholder="Item Name">
        </fieldset>
          <label for="">Student</label>
        <fieldset>
          <input name="s1" type="number" placeholder="1 days">
          <input name="s2" type="number" placeholder="2-3 days">
          <input name="s3" type="number" placeholder="4-6 days">
          <input name="s4" type="number" placeholder="7-10 days">
        </fieldset>
        <label for="">Faculty</label>
        <fieldset>
          <input name="f1" type="number" placeholder="1 days">
          <input name="f2" type="number" placeholder="2-3 days">
          <input name="f3" type="number" placeholder="4-6 days">
          <input name="f4" type="number" placeholder="7-10 days">
        </fieldset>
        <fieldset>
          <button class="right pure-button red"><i class="fa fa-plus" />Add Gear</button>
        </fieldset>
      </form>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(".newRentalForm").submit(function(event) {
  event.preventDefault();
  console.log("saving changes...");
  // var ID = $(this).attr("value");
  // console.log(ID);
  var data = new Rental({
    name: $(this).children().children("input[name=title]").val(),
    student_pricing_1: $(this).children().children("input[name=s1]").val(),
    student_pricing_2: $(this).children().children("input[name=s2]").val(),
    student_pricing_3: $(this).children().children("input[name=s3]").val(),
    student_pricing_4: $(this).children().children("input[name=s4]").val(),
    faculty_pricing_1: $(this).children().children("input[name=s1]").val(),
    faculty_pricing_2: $(this).children().children("input[name=s2]").val(),
    faculty_pricing_3: $(this).children().children("input[name=s3]").val(),
    faculty_pricing_4: $(this).children().children("input[name=s4]").val(),
  });
  console.log(data.attributes);
  app.viewsFactory.rentals().collection.create(data, {
    url: "api/item_rental",
    wait: true,
    success: function(response) {
      eventID = response.id;
      console.log("refreshing view after submittal...");
      app.viewsFactory.rentals().collection.fetch();
    }
  });
});
$(".removeRental").on('click', function() {
  var id = $(this).attr('id');
  console.log("Removing Rental", id);
  app.viewsFactory.rentals().collection.get(id).destroy({url:"api/item_rental/"+id});
});
</script>
</script>

<script type="text/template" id="home">
<div class="header aug-header">
    <h1>Welcome the the U-Rec CMS</h1>
    <h4><i class="red">Click on a link on the left to get started</i></h4>
</div>
</script>


<!-- === Backbone and dependencies === -->

<script src="js/vendor/ui.js"></script>
<script src="js/vendor/jquery-2.1.3.min.js"></script>
<script src="js/vendor/underscore.js"></script>
<script src="js/vendor/backbone.js"></script>
<script src="js/vendor/jquery.cookie.js"></script>
<script src="js/vendor/jquery-ui.js"></script>
<script src="js/vendor/featherlight.js"></script>
<script src="js/vendor/jquery.datetimepicker.js"></script>
<script src="js/vendor/spin.js"></script>

<!-- //Error reporting script -->
<script type="text/javascript" src="js/errorReporting.js"></script>

<!-- === Backbone App === -->

<script src="js/App.js"></script>

<!-- App Models  -->
<script src="js/models/models.js"></script>
<!-- <script src="js/models/announcement.js"></script>
<script src="js/models/rentals.js"></script>
<script src="js/models/image.js"></script> -->

<!-- App Collections -->
<script src="js/collections/collections.js"></script>
<!-- <script src="js/collections/facility.js"></script>
<script src="js/collections/image.js"></script>
<script src="js/collections/rentals.js"></script> -->

<!-- App Views -->
<script src="js/views/views.js"></script>
<!-- <script src="js/views/menu.js"></script>
<script src="js/views/login.js"></script>
<script src="js/views/home.js"></script>
<script src="js/views/rentals.js"></script>
<script src="js/views/insertDummy.js"></script>
<script src="js/views/facilityViews.js"></script>
<script src="js/views/outdoorrecViews.js"></script>
<script src="js/views/climbingwallViews.js"></script>
<script src="js/views/intramuralsViews.js"></script> -->



<script type="text/javascript">
    window.onload = function() {
      $("#loading").hide();
      $(document).ajaxStart(function() {
        $("#loading").show();
      });
      $(document).ajaxComplete(function() {
        $("#loading").hide();
      });
        app.init();
        var opts = {
          lines: 9, // The number of lines to draw
          length: 7, // The length of each line
          width: 4, // The line thickness
          radius: 7, // The radius of the inner circle
          corners: 1, // Corner roundness (0..1)
          rotate: 0, // The rotation offset
          direction: 1, // 1: clockwise, -1: counterclockwise
          color: '#000', // #rgb or #rrggbb or array of colors
          speed: 1, // Rounds per second
          trail: 60, // Afterglow percentage
          shadow: false, // Whether to render a shadow
          hwaccel: false, // Whether to use hardware acceleration
          className: 'spinner', // The CSS class to assign to the spinner
          zIndex: 2e9, // The z-index (defaults to 2000000000)
          top: '5%', // Top position relative to parent
          left: '75%' // Left position relative to parent
        };
        var spinner = new Spinner(opts).spin();
        $("#loading").append(spinner.el);
    }
</script>

<script src="js/script.js"></script>

</body>
</html>
