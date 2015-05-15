<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="U Rec CMS">

        <title>Home</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="m/css/stylesheets/style.css">
  </head>
  <body>
    <div id="error-report"></div>
    <div id="insert">

    </div>

    <script type="text/template" id="main">
      <div class="panel">
        <div class="splash-menu">
          <a href="#facility"><button>U-Rec Center</button></a>
          <a href="#outdoorrec"><button>outdoorrec</button></a>
          <a href="#climbingwall"><button>climbing wall</button></a>
          <a href="#intramurals"><button>intramurals</button></a>
          <a href="#rentals"><button>Rentals</button></a>
          <a href="#facility/feedback"><button>Feedback</button></a>
          <a href="#about"><button>About</button></a>
        </div>
      </div>
    </script>

    <script type="text/template" id="loading"></script>

    <script type="text/template" id="announcementTemplate">
      <% _.each(collection, function(model) { %>
        <div class="panel">
      		<div class="announcement">
      			  <!-- <img src="../urex-app-backend/public/<%=model.file_location%>" alt=""> -->
      				<h3><%=model.title%></h3>
      				<p class="message"><%=model.message%></p>
      		</div>
      	</div>
      <% }); %>
    </script>

    <script type="text/template" id="imageTemplate">
      <% _.each(collection, function(model) { %>
        <div class="image-container">
          <a data-featherlight="#image-<%= model.id %>">
            <img id="image-<%= model.id %>" src="<%= model.file_location %>" title="<%= model.caption %>">
          </a>
          <p><%= model.caption %></p>
        </div>
      <% }); %>
    </script>

    <script type="text/template" id="eventTemplate">
      <% _.each(collection, function(model) { %>
        <div class="panel">
      		<div class="event">
      				<h3><%=model.title%></h3>
      				<div class="content">
                <!-- These will have conditionals, so if they don't have a value they won't show up -->
                <p class="start">Start Date: <%=model.start%></p>
                <p class="end">End Date: <%=model.end%></p>
                <p class="cost">Cost: $<%=model.cost%></p>
                <p class="spots">Spots: <%=model.spots%></p>
                <p class="gear">Gear needed: <%=model.gear_needed%></p>
      				  <p class="message"><%=model.description%></p>
      				</div>
      		</div>
      	</div>
      <% }); %>
    </script>

    <script type="text/template" id="facilityMenu">
      <div class="panel">
    		<div class="splash-menu">
    			<a href = "#facility/announcements">
            <button id="FacilityAnnouncements">Announcements</button>
          </a>
    			<a href = "#facility/events">
            <button id="FacilityEvents">Events</button>
          </a>
    			<a href = "#facility/photos">
            <button id="FacilityPhotos">Photos</button>
          </a>
          <a href="https://www.facebook.com/WhitworthUrec">
    			 <button id="FacilityFacebook">Facebook</button>
          </a>
    		</div>
    	</div>
    </script>

    <script type="text/template" id="outdoorrecMenu">
      <div class="panel">
    		<div class="splash-menu">
    			<a href = "#outdoorrec/announcements">
            <button id="OutdoorRecAnnouncements">Announcements</button>
          </a>
    			<a href = "#outdoorrec/trips">
            <button id="OutdoorRecTrips">Upcoming Trips</button>
          </a>
    			<a href = "#outdoorrec/photos">
            <button id="OutdoorRecPhotos">Photos</button>
          </a>
          <a href = "https://www.facebook.com/WhitworthOutdoorRec">
    			 <button id="OutdoorRecFacebook">Facebook</button>
          </a>
    		</div>
    	</div>
    </script>

    <script type="text/template" id="intramuralsMenu">
      <div class="panel">
    		<div class="splash-menu">
    			<a href = "#intramurals/announcements">
            <button id="IntramuralsAnnouncements">Announcements</button>
          </a>
    			<a href = "#intramurals/photos">
            <button id="IntramuralsPhotos">Photos</button>
          </a>
          <a href = "https://twitter.com/BucsIntramurals">
    			 <button id="IntramuralsTwitter">Twitter</button>
          </a>
    		</div>
    	</div>
    </script>

    <script type="text/template" id="climbingwallMenu">
      <div class="panel">
    		<div class="splash-menu">
    			<a href = "#climbingwall/announcements">
            <button id="ClimbingWallAnnouncements">Announcements</button>
          </a>
    			<a href = "#climbingwall/events">
            <button id="ClimbingWallEvents">Events</button>
          </a>
    			<a href = "#climbingwall/photos">
            <button id="ClimbingWallPhotos">Photos</button>
          </a>
          <a href = "https://www.facebook.com/climbwhitworth">
    			 <button id="ClimbingWallFacebook">Facebook</button>
          </a>
    		</div>
    	</div>
    </script>

    <script type="text/template" id="homeTemplate">
      <div class="panel hours">
    		<p><%=name%> is currently: <p class="info">Open</p></p>
    		<br>
    		<p>Today's Hours:<p class="info">8am - 10am</p></p>
    		<br>
    		<br>
    		<button id="week-popup">This Week's Hours</button>
    	</div>

    	<div data-role="popup" id="hours-popup" data-overlay-theme="a" class="hours-popup panel">
          <h4 class="hours-title">This Week's Hours</h4>
          <% _.each(collection, function(model) { %>
            <p class="info"><%=model.day%>:</p>
              <% if(model.closed) { %>
                <p>CLOSED</p>
                <br>
              <% }
              else {%>
                <% _.each(model.times, function(time) { %>
                  <p><%=time%> </p>
                  <br>
                <% }); %>
              <% } %>
          <% }); %>
    	</div>

      <%= menu %>

      <script type="text/javascript">
        $("#hours-popup").hide();
        $("#week-popup").on('click', function() {
          $("#hours-popup").slideToggle();
          // $(this).fadeOut();
        });
        console.log(<%=toggleHours%>);
        if(<%=toggleHours%>) {
          $(".hours").hide();
        }
      </script>

    </script>

    <script type="text/template" id="rentalTemplate">
      <style>
          .selected {
            background-color: red;
            color: white;
          }
          .rentals-buttons {
            u-webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
          }

          .rentals-buttons span {
            width: 49%;
            display: inline-block;
          }
      </style>
      <div class="panel">
        <div class="rentals-buttons">
          <span class="student-button selected">Student Prices</span>
          <span class="faculty-button">Faculty Prices</span>
        </div>
      </div>
      <div class="panel">
        <table>
          <tr>
            <th>Days:</th>
            <th>1</th>
            <th>2-3</th>
            <th>4-5</th>
            <th>6-7</th>
          </tr>
          <% _.each(collection, function(model) { %>
            <tr class="student">
              <td><%=model.name%></td>
              <td>$<%=model.student_pricing_1%></td>
              <td>$<%=model.student_pricing_2%></td>
              <td>$<%=model.student_pricing_3%></td>
              <td>$<%=model.student_pricing_4%></td>
            </tr>
            <tr class="faculty">
              <td><%=model.name%></td>
              <td>$<%=model.faculty_pricing_1%></td>
              <td>$<%=model.faculty_pricing_2%></td>
              <td>$<%=model.faculty_pricing_3%></td>
              <td>$<%=model.faculty_pricing_4%></td>
            </tr>
          <% }); %>
        </table>
      </div>
      <script type="text/javascript">
        $(".faculty").hide();
        $(".rentals-buttons").on('click', function() {
          console.log("switched");
          $(".student").toggle();
          $(".faculty").toggle();
          $(".student-button").toggleClass("selected");
          $(".faculty-button").toggleClass("selected");
        });
      </script>
    </script>

    <script type="text/template" id="feedback">
      <div class="panel feedback">
        <form id="feedbackForm">
          <input id="feedbackEmail" type="text" placeholder="My Email">
          <br>
          <textarea id="feedbackMessage" name="" id="" rows="5">Message</textarea>
          <br>
          <button>Submit Feedback</button>
        </form>
      </div>
      <div class="panel feedbackSuccess">
        <h3>Thank you for your feedback!</h3>
        <p>Your message is highly appreciated and will be taken into consideration. A representative of the U-Rec Center may be in touch with you later about any concerns you have.</p>
      </div>
      <script type="text/javascript">
      $(".feedbackSuccess").hide();
        $("#feedbackForm").on("submit", function(e) {
          e.preventDefault();
          var data = {
            email: $("#feedbackEmail").val(),
            message: $("#feedbackMessage").val(),
            date: new Date().toString().split(" G")[0],
          };
          $.ajax({
            url: "../urex-app-backend/public/api/feedback",
            data: data,
            method: "POST",
            success: function() {
              $(".feedback").hide();
              $(".feedbackSuccess").show();
            }
          });
        });
      </script>
    </script>

    <script type="text/template" id="aboutView">
      <div class="panel">
        <p>This app made with  <i class="fa fa-heart-o"></i>  from the U-Rex team</p>
      </div>
      <div class="panel">
        <h4>Hannah Gamiel</h4>
        <p>Mobile Development</p>
      </div>
      <div class="panel">
        <h4>Lauren Pangborn</h4>
        <p>Design, User Experience, Mobile Development</p>
      </div>
      <div class="panel">
        <h4>Joey Corry</h4>
        <p>Backend developer</p>
      </div>
      <div class="panel">
        <h4>Sean Cunningham</h4>
        <p>Task Manager, Server Management, Research</p>
      </div>
      <div class="panel">
        <h4>Bryan Hassell</h4>
        <p>Web Developer</p>
      </div>
      <div class="panel">
        <h4>Pete Tucker</h4>
        <p>Comp Sci Professor, Project Manager</p>
      </div>
      <div class="panel">
        <h4>Todd Sandberg</h4>
        <p>Client</p>
      </div>
    </script>

    <script type="text/template" id="error-report-template">
      <p class="error-type">Error:</p>
      <p class="error-text"><%= message %></p>
      <a id="error-close"><i class="fa fa-times right"></i></a>
      <script type="text/javascript">
      $("#error-close").on("click", function() {
        $("#error-report").slideToggle();
      });
    </script>


  </body>
  <footer>
    <!-- Backbone and dependencies -->
    <script src="m/js/vendor/jquery-2.1.3.min.js"></script>
    <script src="m/js/vendor/underscore.js"></script>
    <script src="m/js/vendor/backbone.js"></script>
    <script src="m/js/vendor/spin.js"></script>
    <script src="m/js/vendor/moment.js"></script>

    <!-- Error Checking -->
    <script src="m/js/error.js"></script>

    <!-- Backbone App -->
    <script src="m/js/app.js"></script>

    <!-- Models -->
    <script src="m/js/models.js"></script>

    <!-- Collections -->
    <script src="m/js/collections.js"></script>
    <!-- Views -->
    <script src="m/js/views/views.js"></script>

    <script type="text/javascript">
    // $("#loading").hide();
      window.onload = function() {
          app.init();
          var opts = {
            lines: 13, // The number of lines to draw
            length: 15, // The length of each line
            width: 4, // The line thickness
            radius: 17, // The radius of the inner circle
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
            top: '50%', // Top position relative to parent
            left: '50%' // Left position relative to parent
          };
          var spinner = new Spinner(opts).spin();
          $("#loading").append(spinner.el);
      }

    </script>

  </footer>
</html>
