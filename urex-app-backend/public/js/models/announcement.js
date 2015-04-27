app.models.announcement = Backbone.Model.extend({
  initialize: function() {
    // console.log("initialized announcement model");
  },
  defaults: {
    "id": "000",
    "category_id": "000",
    "user_id": "000",
    "title": "New Title",
    "message": "Details",
    "date": "05/22/1993"
  }
})
