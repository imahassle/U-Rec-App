<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="U Rec CMS">

    <title>U Rec &ndash; CMS</title>


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

    <div class="header aug-top-bar">
        <label for="logout-button">Hello, User!</label>
        <a id="logout-button" href="#">Log out</a>
    </div>

    <div id="menu"></div>

    <div id="main">
    </div>
    <!-- Ignore below -->
</div>

<!-- === Views === -->



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
      $.cookie('U-Rex-API-Key', data.api_key);
      console.log($.cookie('U-Rex-API-Key'));
      $.ajaxSetup({
        headers: { 'X-Authorization' : $.cookie('U-Rex-API-Key')}
      });
    });
  });
  </script>

</script>

<script type="text/template" id="facilityHome">
<div class="header aug-header">
    <h1>Facilities Home</h1>
</div>
    <div class="content home-view pure-g">
        <!-- Welcome Banner and Post form -->
        <div class="home-channel pure-u-3-5">
            <div class="home-main-banner">
                <h3 class="banner">Announcements</h3>
                <form action="javascript:" id="facilities-announcement" class="pure-form pure-form-stacked">
                    <h4>New Announcement</h4>
                    <button type="submit" class="pure-button pure-button-primary right red">POST</button>
                    <input name="title" type="text" placeholder="Program Title">
                    <textarea name="message" id="programDetails" cols="62" rows="2" placeholder="Details"></textarea>
                </form>
            </div>
            <!-- Announcement Template Below -->
            <% _.each(app.viewsFactory.facilityHome().collection.toJSON(), function(model) { %>
              <div class="home-announcement">
                  <i class="fa fa-trash fa-2x right red"></i>
                  <i class="fa fa-edit fa-2x right red"></i>
                  <p class="announcement-date"><%= model.date %></p>
                  <h4><%= model.title %></h4>
                  <p class="announcement-blurb"><%= model.message %></p>
              </div>
            <% }); %>

        </div>
        <!-- Quick links menu here -->
        <div class="pure-u-2-5 quick-menu">
            <a href="#facilites/hours"><div class="quick-item"><i class="fa fa-clock-o fa-3x"></i><h3>Facility Hours</h3></div></a>
            <a href="#facility/programs"><div class="quick-item"><i class="fa fa-git fa-3x"></i><h3>Incentive Programs</h3></div></a>
            <a href="#facility/events"><div class="quick-item"><i class="fa fa-calendar fa-3x"></i><h3>Events</h3></div></a>
            <a href="#facility/photos"><div class="quick-item"><i class="fa fa-picture-o fa-3x"></i><h3>Photos</h3></div></a>
            <a href="#facility/feedback"><div class="quick-item"><i class="fa fa-comment fa-3x"></i><h3>View Feedback</h3></div></a>
            <a href="#"><div class="quick-item"><i class="fa fa-facebook fa-3x"></i><h3>Facebook</h3></div></a>
        </div>
    </div>
    <script type="text/javascript">
      $('#facilities-announcement').on("submit", function(event) {
        event.preventDefault();
        var data = {
          title: $("#facilities-announcement > input[name='title']").val(),
          message: $("#facilities-announcement > textarea[name='message']").val(),
          date: new Date().toString().split(" G")[0],
        };
        console.log(data);
        app.viewsFactory.facilityHome().collection.create(data, {
          url: "api/announcement",
          wait: true,
        });
        // console.log(app);
        // $.ajax({
        //   url: "api/announcement",
        //   method: "POST",
        //   data: data
        // }).done(function(data) {
        //   console.log("complete: ", data);
        // });
      });
    </script>
</script>

<script type="text/template" id="facilityFeedback"></script>

<script type="text/template" id="outdoorrecHome">
<div class="header aug-header">
    <h1>Outdoor Rec Home</h1>
</div>
    <div class="content home-view pure-g">
        <!-- Welcome Banner and Post form -->
        <div class="home-channel pure-u-3-5">
            <div class="home-main-banner">
                <h3 class="banner">Announcements</h3>
                <form class="pure-form pure-form-stacked">
                    <h4>New Announcement</h4>
                    <button type="submit" class="pure-button pure-button-primary right red">POST</button>
                    <input type="text" placeholder="Title">
                    <textarea name="details" id="programDetails" cols="62" rows="2" placeholder="Details"></textarea>
                </form>
            </div>
            <!-- Announcement Template Below -->
            <div class="home-announcement">
                <i class="fa fa-trash fa-2x right red"></i>
                <i class="fa fa-edit fa-2x right red"></i>
                <p class="announcement-date">March 13th at 9:04am</p>
                <h4>3 More Spots in our Spring Break trip!</h4>
                <p class="announcement-blurb">Spots are going fast. Come sign up in the U-Rec to reserve your spot! Cost is $350.</p>
            </div>
            <div class="home-announcement">
                <i class="fa fa-trash fa-2x right red"></i>
                <i class="fa fa-edit fa-2x right red"></i>
                <p class="announcement-date">March 13th at 9:04am</p>
                <h4>3 More Spots in our Spring Break trip!</h4>
                <p class="announcement-blurb">Spots are going fast. Come sign up in the U-Rec to reserve your spot! Cost is $350.</p>
            </div>
        </div>
        <!-- Quick links menu here -->
        <div class="pure-u-2-5 quick-menu">
            <a href="#outdoorrec/trips"><div class="quick-item"><i class="fa fa-calendar fa-3x"></i><h3>Trips</h3></div></a>
            <a href="#outdoorrec/photos"><div class="quick-item"><i class="fa fa-picture-o fa-3x"></i><h3>Photos</h3></div></a>
            <a href="#"><div class="quick-item"><i class="fa fa-facebook fa-3x"></i><h3>Facebook</h3></div></a>
        </div>
    </div>
</script>

<script type="text/template" id="intramuralsHome">
<div class="header aug-header">
    <h1>Intramurals Home</h1>
</div>
    <div class="content home-view pure-g">
        <!-- Welcome Banner and Post form -->
        <div class="home-channel pure-u-3-5">
            <div class="home-main-banner">
                <h3 class="banner">Announcements</h3>
                <form class="pure-form pure-form-stacked">
                    <h4>New Announcement</h4>
                    <button type="submit" class="pure-button pure-button-primary right red">POST</button>
                    <input type="text" placeholder="Title">
                    <textarea name="details" id="programDetails" cols="62" rows="2" placeholder="Details"></textarea>
                </form>
            </div>
            <!-- Announcement Template Below -->
            <div class="home-announcement">
                <i class="fa fa-trash fa-2x right red"></i>
                <i class="fa fa-edit fa-2x right red"></i>
                <p class="announcement-date">March 13th at 9:04am</p>
                <h4>3 More Spots in our Spring Break trip!</h4>
                <p class="announcement-blurb">Spots are going fast. Come sign up in the U-Rec to reserve your spot! Cost is $350.</p>
            </div>
            <div class="home-announcement">
                <i class="fa fa-trash fa-2x right red"></i>
                <i class="fa fa-edit fa-2x right red"></i>
                <p class="announcement-date">March 13th at 9:04am</p>
                <h4>3 More Spots in our Spring Break trip!</h4>
                <p class="announcement-blurb">Spots are going fast. Come sign up in the U-Rec to reserve your spot! Cost is $350.</p>
            </div>
        </div>
        <!-- Quick links menu here -->
        <div class="pure-u-2-5 quick-menu">
            <a href="#outdoorrec/photos"><div class="quick-item"><i class="fa fa-picture-o fa-3x"></i><h3>Photos</h3></div></a>
            <a href="#outdoorrec/trips"><div class="quick-item"><i class="fa fa-futbol-o fa-3x"></i><h3>IMLeagues</h3></div></a>
            <a href="#"><div class="quick-item"><i class="fa fa-twitter fa-3x"></i><h3>Twitter</h3></div></a>
        </div>
    </div>
</script>

<script type="text/template" id="facilityHours">
  <div class="header aug-header">
          <h1>Facility Hours</h1>
      </div>
      <div class="content">
          <div class="creation">
              <div class="buttons-group">
                  <button type="submit" class="pure-button pure-button-primary right red">Save Hours</button>
              </div>
              <h3>Set the standard open hours for the facility:</h3>
              <form class="pure-form pure-form-aligned">
                  <div class="pure-control-group">
                      <label for="startTime">Monday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Tuesday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Wednesday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Thursday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Friday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Saturday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Sunday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <br>
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
</script>



<script type='text/template' id="facilityPhotos">
    <div class="header aug-header">
        <h1>Facility Photos</h1>
    </div>
    <div class="content pure-g photos-view">
        <div class=" pure-u-4-5 ">
            <div class="pure-g">
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/400x600/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/400x600/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
            </div>
        </div>
        <button class="pure-button perm-button red">Upload Photos</button>
    </div>
</script>

<script type="text/template" id="climbingwallHome">
    <div class="header aug-header">
    <h1>Climbing Wall Home</h1>
</div>
    <div class="content home-view pure-g">
        <!-- Welcome Banner and Post form -->
        <div class="home-channel pure-u-3-5">
            <div class="home-main-banner">
                <h3 class="banner">Announcements</h3>
                <form class="pure-form pure-form-stacked">
                    <h4>New Announcement</h4>
                    <button type="submit" class="pure-button pure-button-primary right red">POST</button>
                    <input type="text" placeholder="Title">
                    <textarea name="details" id="programDetails" cols="62" rows="2" placeholder="Details"></textarea>
                </form>
            </div>
            <!-- Announcement Template Below -->
            <div class="home-announcement">
                <i class="fa fa-trash fa-2x right red"></i>
                <i class="fa fa-edit fa-2x right red"></i>
                <p class="announcement-date">March 13th at 9:04am</p>
                <h4>3 More Spots in our Spring Break trip!</h4>
                <p class="announcement-blurb">Spots are going fast. Come sign up in the U-Rec to reserve your spot! Cost is $350.</p>
            </div>
            <div class="home-announcement">
                <i class="fa fa-trash fa-2x right red"></i>
                <i class="fa fa-edit fa-2x right red"></i>
                <p class="announcement-date">March 13th at 9:04am</p>
                <h4>3 More Spots in our Spring Break trip!</h4>
                <p class="announcement-blurb">Spots are going fast. Come sign up in the U-Rec to reserve your spot! Cost is $350.</p>
            </div>
        </div>
        <!-- Quick links menu here -->
        <div class="pure-u-2-5 quick-menu">
            <a href="#climbingwall/photos"><div class="quick-item"><i class="fa fa-picture-o fa-3x"></i><h3>Photos</h3></div></a>
            <a href="#outdoorrec/trips"><div class="quick-item"><i class="fa fa-barcode fa-3x"></i><h3>Climb Stuff</h3></div></a>
            <a href="#"><div class="quick-item"><i class="fa fa-twitter fa-3x"></i><h3>Twitter</h3></div></a>
            <a href="#"><div class="quick-item"><i class="fa fa-facebook fa-3x"></i><h3>Facebook</h3></div></a>
        </div>
    </div>
</script>

<script type="text/template" id="facilityProg">
    <div class="header aug-header">
        <h1>Incentive Programs</h1>
    </div>
    <div class="content">
        <div class="creation">
            <h3>Create a New Incentive Program</h3>
            <div class="buttons-group">
                <button class="pure-button medGray">Clear</button>
                <button class="pure-button red">Done</button>
            </div>
            <form class="pure-form pure-form-stacked">
                <input type="text" class="pure-u-1-3" placeholder="Program Title">
                <textarea name="" class="pure-u-1" id="" rows="4" placeholder="Details"></textarea>
            </form>
        </div>
        <div class="creation">
            <h4>Lunge to Dutch Bros (Feb 23-27)</h4>
            <div class="buttons-group">
                <i class="fa fa-edit fa-2x icon-hover"></i>
                <i class="fa fa-trash fa-2x icon-hover"></i>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ultrices viverra libero, sed bibendum tellus malesuada nec. Nunc volutpat egestas urna. Pellentesque luctus mauris a pretium euismod. Donec ac dictum leo. Donec id dolor turpis. Nulla facilisis lobortis ligula, nec fringilla sapien. Sed a condimentum magna. Pellentesque feugiat risus vitae magna iaculis, dignissim laoreet urna luctus. Phasellus tempor aliquam justo, a rutrum neque sollicitudin eget. Maecenas venenatis dictum dolor eu sollicitudin. Curabitur sed blandit ante, vel ullamcorper augue.</p>
        </div>
        <div class="creation">
            <div class="buttons-group">
                <button class="pure-button medGray">Cancel</button>
                <button class="pure-button red">Save</button>
                <i class="fa fa-trash fa-2x icon-hover"></i>
            </div>
            <form class="pure-form pure-form-stacked">
                <input type="text" class="pure-u-1-3" placeholder="Program Title" value="100 Miles in March (March 1-31)">
                <textarea name="" id="" rows="4" class="pure-u-1" placeholder="Details">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ultrices viverra libero, sed bibendum tellus malesuada nec. Nunc volutpat egestas urna. Pellentesque luctus mauris a pretium euismod. Donec ac dictum leo. Donec id dolor turpis. Nulla facilisis lobortis ligula, nec fringilla sapien. Sed a condimentum magna. Pellentesque feugiat risus vitae magna iaculis, dignissim laoreet urna luctus. Phasellus tempor aliquam justo, a rutrum neque sollicitudin eget. Maecenas venenatis dictum dolor eu sollicitudin. Curabitur sed blandit ante, vel ullamcorper augue.</textarea>
            </form>
        </div>
    </div>
</script>

<script type="text/template" id="facilityEvents">
    <div class="header aug-header">
        <h1>Facility Events</h1>
    </div>
    <div class="content">
        <div class="creation">
            <h3>Create a New Event</h3>
            <div class="buttons-group">
                <button class="pure-button medGray">Clear</button>
                <button class="pure-button red">Done</button>
            </div>
            <form class="pure-form pure-form-aligned">
                <div class="pure-control-group">
                <input type="text" class="pure-u-1-3" placeholder="Event Title">
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel" for="startTime">Starts at</label>
                    <input id="startTime" class="pure-u-1-5" type="text">
                    <label class="secondLabel">on</label>
                    <input class="pure-u-1-5" type="text">
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel" for="endTime">Ends at</label>
                    <input type="text">
                    <label class="secondLabel">on</label>
                    <input type="text">
                </div>
                <div class="pure-control-group">
                <textarea name="" id="" rows="4" class="pure-u-1" placeholder="Details"></textarea>
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel">Photo</label>
                    <button class="pure-button medGray">Upload a photo</button>
                    <p>C:/self/documents/somewhere/temp/localstorage/win32/pic.png</p>
                </div>
            </form>
        </div>
        <div class="creation">
            <img src="http://dummyimage.com/600x400/000/fff">
            <h4>Oh. You need a little dummy text for your mockup? How quaint. (Feb 23-27)</h4>
            <h5>2:00PM, February 7 - 6:00pm, February 8</h5>
            <div class="buttons-group">
                <i class="fa fa-edit fa-2x icon-hover"></i>
                <i class="fa fa-trash fa-2x icon-hover"></i>
            </div>
            <p>Art party cardigan polaroid, roof party locavore craft beer pug authentic. Selfies chambray lumbersexual sartorial seitan, roof party locavore Tumblr literally cold-pressed typewriter tattooed photo booth Godard. Taxidermy tofu deep v, seitan scenester salvia Pitchfork next level mixtape butcher XOXO fashion axe vegan whatever cardigan. Health goth hashtag literally, four loko swag cold-pressed artisan pug bitters roof party Austin banh mi. Fixie Brooklyn pug Tumblr distillery. Asymmetrical kitsch hashtag tofu Kickstarter butcher. Vinyl try-hard Godard cold-pressed Bushwick asymmetrical, swag 90''s meh raw denim post-ironic fingerstache seitan.</p>
        </div>
        <div class="creation">
            <div class="buttons-group">
                <button class="pure-button medGray">Cancel</button>
                <button class="pure-button red">Save</button>
                <i class="fa fa-trash fa-2x icon-hover"></i>
            </div>
            <form class="pure-form pure-form-stacked">
                <input type="text" class="pure-u-1-3" placeholder="Program Title" value="I bet you’re still using Bootstrap too… (March 1-31)">
                <textarea name="" id="" rows="4" class="pure-u-1" placeholder="Details">Kickstarter seitan Thundercats meh, viral keytar whatever taxidermy squid distillery literally migas try-hard. Shabby chic Austin fixie, whatever Schlitz lo-fi tattooed vegan 3 wolf moon flannel sriracha. Williamsburg Helvetica ennui cold-pressed Pitchfork, Etsy fashion axe gluten-free tousled stumptown mustache Odd Future. Dreamcatcher cronut leggings, plaid gluten-free single-origin coffee kogi Vice Pinterest. Blog single-origin coffee small batch chia synth crucifix. Cliche cornhole asymmetrical slow-carb, Vice listicle ennui Shoreditch Marfa DIY vinyl. American Apparel cronut McSweeneys, hoodie YOLO Vice +1 cray.</textarea>
            </form>
        </div>
    </div>
</script>

<script type="text/template" id="outdoorrecTrips">
    <div class="header aug-header">
        <h1>Outdoor Rec Trips</h1>
    </div>
    <div class="content">
        <div class="creation">
            <h3>Create a New Trip</h3>
            <div class="buttons-group">
                <button class="pure-button medGray">Clear</button>
                <button class="pure-button red">Done</button>
            </div>
            <form class="pure-form pure-form-aligned">
                <div class="pure-control-group">
                    <input type="text" class="pure-u-1-3" placeholder="Trip Title">

                </div>
                <div class="pure-control-group">
                    <label class="firstLabel" for="startTime">Starts at</label>
                    <input id="startTime" class="pure-u-1-5" type="text">
                    <label class="secondLabel">on</label>
                    <input class="pure-u-1-5" type="text">
                    <label class="">Price</label>
                    <input class="pure-u-1-12" type="text">
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel" for="endTime">Ends at</label>
                    <input type="text">
                    <label class="secondLabel">on</label>
                    <input type="text">
                    <label class="">Spots</label>
                    <input class="pure-u-1-12" type="text">
                </div>
                <div class="pure-control-group">
                <input type="text" class="pure-u-1-2" placeholder="Experience needed">
                </div>
                <div class="pure-control-group">
                <input type="text" class="pure-u-1-2" placeholder="Gear students need to bring">
                </div>
                <div class="pure-control-group">
                <textarea name="" id="" rows="4" class="pure-u-1" placeholder="Details"></textarea>
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel">Photo</label>
                    <button class="pure-button medGray">Upload a photo</button>
                    <p>C:/self/documents/somewhere/temp/localstorage/win32/pic.png</p>
                </div>
            </form>
        </div>
        <div class="creation">
            <img src="http://dummyimage.com/600x400/000/fff">
            <h4>Oh. You need a little dummy text for your mockup? How quaint. (Feb 23-27)</h4>
            <h5>2:00PM, February 7 - 6:00pm, February 8 - 21 spots - $3.50</h5>
            <div class="buttons-group">
                <i class="fa fa-edit fa-2x icon-hover"></i>
                <i class="fa fa-trash fa-2x icon-hover"></i>
            </div>
            <p>Art party cardigan polaroid, roof party locavore craft beer pug authentic. Selfies chambray lumbersexual sartorial seitan, roof party locavore Tumblr literally cold-pressed typewriter tattooed photo booth Godard. Taxidermy tofu deep v, seitan scenester salvia Pitchfork next level mixtape butcher XOXO fashion axe vegan whatever cardigan. Health goth hashtag literally, four loko swag cold-pressed artisan pug bitters roof party Austin banh mi. Fixie Brooklyn pug Tumblr distillery. Asymmetrical kitsch hashtag tofu Kickstarter butcher. Vinyl try-hard Godard cold-pressed Bushwick asymmetrical, swag 90''s meh raw denim post-ironic fingerstache seitan.</p>
        </div>
        <div class="creation">
            <div class="buttons-group">
                <button class="pure-button medGray">Cancel</button>
                <button class="pure-button red">Save</button>
                <i class="fa fa-trash fa-2x icon-hover"></i>
            </div>
            <form class="pure-form pure-form-stacked">
                <input type="text" class="pure-u-1-2" placeholder="Program Title" value="I bet you’re still using Bootstrap too… (March 1-31)">
                <textarea name="" id="" rows="4" class="pure-u-1" placeholder="Details">Kickstarter seitan Thundercats meh, viral keytar whatever taxidermy squid distillery literally migas try-hard. Shabby chic Austin fixie, whatever Schlitz lo-fi tattooed vegan 3 wolf moon flannel sriracha. Williamsburg Helvetica ennui cold-pressed Pitchfork, Etsy fashion axe gluten-free tousled stumptown mustache Odd Future. Dreamcatcher cronut leggings, plaid gluten-free single-origin coffee kogi Vice Pinterest. Blog single-origin coffee small batch chia synth crucifix. Cliche cornhole asymmetrical slow-carb, Vice listicle ennui Shoreditch Marfa DIY vinyl. American Apparel cronut McSweeneys, hoodie YOLO Vice +1 cray.</textarea>
            </form>
        </div>
    </div>
</script>

<script type="text/template" id="outdoorrecPhotos">
    <div class="header aug-header">
        <h1>Outdoor Rec Photos</h1>
    </div>
    <div class="content pure-g photos-view">
        <div class=" pure-u-4-5 ">
            <div class="pure-g">
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/400x600/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/400x600/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
            </div>
        </div>
        <button class="pure-button perm-button red">Upload Photos</button>
    </div>
</script>

<script type="text/template" id="intramuralsPhotos">
    <div class="header aug-header">
        <h1>Intramurals Photos</h1>
    </div>
    <div class="content pure-g photos-view">
        <div class=" pure-u-4-5 ">
            <div class="pure-g">
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/400x600/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/400x600/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
            </div>
        </div>
        <button class="pure-button perm-button red">Upload Photos</button>
    </div>
</script>

<script type="text/template" id="climbingwallHours">
  <div class="header aug-header">
          <h1>Climbing Wall Hours</h1>
      </div>
      <div class="content">
          <div class="creation">
              <div class="buttons-group">
                  <button type="submit" class="pure-button pure-button-primary right red">Save Hours</button>
              </div>
              <h3>Set the standard open hours for the climbing wall:</h3>
              <form class="pure-form pure-form-aligned">
                  <div class="pure-control-group">
                      <label for="startTime">Monday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Tuesday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Wednesday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Thursday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Friday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Saturday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <div class="pure-control-group">
                      <label for="startTime">Sunday</label>
                      <input id="startTime" class="pure-u-1-5" type="time">
                      <label class="secondLabel">to</label>
                      <input class="pure-u-1-5" type="time">
                      <button class="pure-button round-button">
                        <i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <br>
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
</script>

<script type="text/template" id="climbingwallPhotos">
    <div class="header aug-header">
        <h1>Climbing Wall Photos</h1>
    </div>
    <div class="content pure-g photos-view">
        <div class=" pure-u-4-5 ">
            <div class="pure-g">
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/400x600/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/400x600/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
                <div class="pure-u-1-4"><img src="http://dummyimage.com/600x400/000/fff" alt=""></div>
            </div>
        </div>
        <button class="pure-button perm-button red">Upload Photos</button>
    </div>
</script>

<script type="text/template" id="climbingwallEvents">
    <div class="header aug-header">
        <h1>Climbing Wall Events</h1>
    </div>
    <div class="content">
        <div class="creation">
            <h3>Create a New Event</h3>
            <div class="buttons-group">
                <button class="pure-button medGray">Clear</button>
                <button class="pure-button red">Done</button>
            </div>
            <form class="pure-form pure-form-aligned">
                <div class="pure-control-group">
                    <input type="text" class="pure-u-1-3" placeholder="Event Title">
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel" for="startTime">Starts at</label>
                    <input id="startTime" class="pure-u-1-5" type="text">
                    <label class="secondLabel">on</label>
                    <input class="pure-u-1-5" type="text">
                    <label class="">Price</label>
                    <input class="pure-u-1-12" type="text">
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel" for="endTime">Ends at</label>
                    <input type="text">
                    <label class="secondLabel">on</label>
                    <input type="text">
                </div>
                <div class="pure-control-group">
                <textarea name="" id="" rows="4" class="pure-u-1" placeholder="Details"></textarea>
                </div>
                <div class="pure-control-group">
                    <label class="firstLabel">Photo</label>
                    <button class="pure-button medGray">Upload a photo</button>
                    <p>C:/self/documents/somewhere/temp/localstorage/win32/pic.png</p>
                </div>
            </form>
        </div>
        <div class="creation">
            <img src="http://dummyimage.com/600x400/000/fff">
            <h4>Oh. You need a little dummy text for your mockup? How quaint. (Feb 23-27)</h4>
            <h5>2:00PM, February 7 - 6:00pm, February 8</h5>
            <div class="buttons-group">
                <i class="fa fa-edit fa-2x icon-hover"></i>
                <i class="fa fa-trash fa-2x icon-hover"></i>
            </div>
            <p>Art party cardigan polaroid, roof party locavore craft beer pug authentic. Selfies chambray lumbersexual sartorial seitan, roof party locavore Tumblr literally cold-pressed typewriter tattooed photo booth Godard. Taxidermy tofu deep v, seitan scenester salvia Pitchfork next level mixtape butcher XOXO fashion axe vegan whatever cardigan. Health goth hashtag literally, four loko swag cold-pressed artisan pug bitters roof party Austin banh mi. Fixie Brooklyn pug Tumblr distillery. Asymmetrical kitsch hashtag tofu Kickstarter butcher. Vinyl try-hard Godard cold-pressed Bushwick asymmetrical, swag 90''s meh raw denim post-ironic fingerstache seitan.</p>
        </div>
        <div class="creation">
            <div class="buttons-group">
                <button class="pure-button medGray">Cancel</button>
                <button class="pure-button red">Save</button>
                <i class="fa fa-trash fa-2x icon-hover"></i>
            </div>
            <form class="pure-form pure-form-stacked">
                <input type="text" class="pure-u-1-2" placeholder="Program Title" value="I bet you’re still using Bootstrap too… (March 1-31)">
                <textarea name="" id="" rows="4" class="pure-u-1" placeholder="Details">Kickstarter seitan Thundercats meh, viral keytar whatever taxidermy squid distillery literally migas try-hard. Shabby chic Austin fixie, whatever Schlitz lo-fi tattooed vegan 3 wolf moon flannel sriracha. Williamsburg Helvetica ennui cold-pressed Pitchfork, Etsy fashion axe gluten-free tousled stumptown mustache Odd Future. Dreamcatcher cronut leggings, plaid gluten-free single-origin coffee kogi Vice Pinterest. Blog single-origin coffee small batch chia synth crucifix. Cliche cornhole asymmetrical slow-carb, Vice listicle ennui Shoreditch Marfa DIY vinyl. American Apparel cronut McSweeneys, hoodie YOLO Vice +1 cray.</textarea>
            </form>
        </div>
    </div>
</script>

<script type="text/template" id="cms-menu">
<div class="pure-menu custom-restricted-width">
    <ul id="menu" class="pure-menu-list">
        <a class="pure-menu-heading" href="#">U Rec CMS</a>
        <div class="menu-space"></div>
        <li class="pure-menu-item"><a href="#facility" class="pure-menu-link">Facility</a></li>
            <ul class="pure-menu-list">
                <li><a href="#facility/hours" class="pure-menu-link">Hours</a></li>
                <li><a href="#facility/programs" class="pure-menu-link">Incentive Programs</a></li>
                <li><a href="#facility/events" class="pure-menu-link">Events</a></li>
                <li><a href="#facility/photos" class="pure-menu-link">Photos</a></li>
                <li><a href="#facility/feedback" class="pure-menu-link">View feedback</a></li>
            </ul>
        <li class="pure-menu-item"><a href="#outdoorrec"class="pure-menu-link">Outdoor Rec</a></li>
            <ul class="pure-menu-list">
                <li><a href="#outdoorrec/trips" class="pure-menu-link">Trips</a></li>
                <li><a href="#outdoorrec/photos" class="pure-menu-link">Photos</a></li>
            </ul>
        <li class="pure-menu-item"><a href="#intramurals"class="pure-menu-link">Intramurals</a></li>
            <ul class="pure-menu-list">
                <li><a href="#intramurals/photos" class="pure-menu-link">Photos</a></li>
            </ul>
        <li class="pure-menu-item"><a href="#climbingwall"class="pure-menu-link">Climbing Wall</a></li>
            <ul class="pure-menu-list">
                <li><a href="#climbingwall/hours" class="pure-menu-link">Hours</a></li>
                <li><a href="#climbingwall/photos" class="pure-menu-link">Photos</a></li>
                <li><a href="#climbingwall/events" class="pure-menu-link">Events</a></li>
            </ul>
        <li class="pure-menu-item"><a href="#rentals" class="pure-menu-link">Rentals</a></li>
        <!--<li class="pure-menu-item"><a href="#stats" class="pure-menu-link">Stats</a></li> -->
        <!--<li class="pure-menu-item"><a href="#login" class="pure-menu-link">Login</a></li> -->
    </ul>
</div>
</script>




<script type="text/template" id="rentals">
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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="aug-tr-lead">Backpack</td>
                <td>$1</td>
                <td>$2</td>
                <td>$30</td>
                <td>$40</td>
                <td>$1</td>
                <td>$2</td>
                <td>$30</td>
                <td>$40</td>
            </tr>
            <tr>
                <td class="aug-tr-lead">Bike Helmet</td>
                <td>$1</td>
                <td>$2</td>
                <td>$30</td>
                <td>$40</td>
                <td>$1</td>
                <td>$2</td>
                <td>$30</td>
                <td>$40</td>
            </tr>
            <tr>
                <td class="aug-tr-lead">Bocce Ball Set</td>
                <td>$1</td>
                <td>$2</td>
                <td>$30</td>
                <td>$40</td>
                <td>$1</td>
                <td>$2</td>
                <td>$30</td>
                <td>$40</td>
            </tr>
            <tr>
                <td class="aug-tr-lead">Tent all season - 3 person</td>
                <td>$1</td>
                <td>$2</td>
                <td>$30</td>
                <td>$40</td>
                <td>$1</td>
                <td>$2</td>
                <td>$30</td>
                <td>$40</td>
            </tr>
        </tbody>
    </table>
    <form class="pure-form right">
        <button class="pure-button button-error"><i class="fa fa-minus" />Remove Gear</button>
        <button class="pure-button button-success"><i class="fa fa-plus" />Add Gear</button>
    </form>
</div>
</div>

</script>



<script type="text/template" id="login-prompt">
<div class="content">
    <form id="login-form" class="pure-form login-prompt">
        <!-- <div id="load-ani" class="spinner">
          <div class="rect1"></div>
          <div class="rect2"></div>
          <div class="rect3"></div>
          <div class="rect4"></div>
          <div class="rect5"></div>
        </div> -->

        <fieldset class="pure-group">
            <legend>Login</legend>
            <h2 class="pure-sub-header" <%= valid %>>Invalid login</h2>
            <!-- <label for="username">Username</label> -->
            <input id="username" class="pure-input-1" type="text" placeholder="Username">
            <!-- <label for="password">Password</label> -->
            <input id="password" class="pure-input-1" type="password" placeholder="Password">
            <button type="submit" class="pure-button pure-input-1 pure-button-primary">Login</button>
        </fieldset>
    </form>

</div>
</script>

<script type="text/template" id="home">
<div class="header aug-header">
    <h1>Home</h1>
</div>
<div class="content">
</div>
</script>

<script type='text/template' id="dummy">
<div class="header aug-header">
    <h1>Dummy Page</h1>
</div>
<div class="content">
    <p>Lorem Ipsum</p>
</div>
</script>


<!-- === Backbone and dependencies === -->

<script src="js/vendor/ui.js"></script>
<script src="js/vendor/jquery-2.1.3.min.js"></script>
<script src="js/vendor/underscore.js"></script>
<script src="js/vendor/backbone.js"></script>
<script src="js/vendor/jquery.cookie.js"></script>
<script src="js/vendor/jquery-ui.js"></script>


<!-- === Backbone App === -->

<script src="js/App.js"></script>

<!-- App Models  -->
<script src="js/models/announcement.js"></script>
<!-- App Collections -->
<script src="js/collections/facility.js"></script>

<script src="js/models/rentals.js"></script>
<script src="js/collections/rentals.js"></script>
<script src="js/views/menu.js"></script>
<!-- <script src="js/views/about.js"></script> -->
<script src="js/views/login.js"></script>
<script src="js/views/home.js"></script>
<script src="js/views/rentals.js"></script>
<script src="js/views/insertDummy.js"></script>
<script src="js/views/facilityViews.js"></script>
<script src="js/views/outdoorrecViews.js"></script>
<script src="js/views/climbingwallViews.js"></script>
<script src="js/views/intramuralsViews.js"></script>

<script type="text/javascript">
    window.onload = function() {
        app.init();
    }
</script>

<script src="js/script.js"></script>

</body>
</html>
