var Announcement = Backbone.Model.extend({
  initialize: function() {
    // console.log("initialized announcement model");
  },
  defaults: {
    "id": "",
    "category_id": "",
    "user_id": "",
    "title": "New Title",
    "message": "Details",
    "date": "05/22/1993"
  }
});

var announcement = new Announcement;
