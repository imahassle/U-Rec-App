app.models.announcement = Backbone.Model.extend({
  initialize: function() {
    console.log("initialized announcement model");
  },
  defaults: {
    id: "000",
    title: "New Title",
    details: "Details",
    date: "05/22/1993"
  }
})
