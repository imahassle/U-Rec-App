var Image = Backbone.Model.extend({
  
  initialize: function() {
    // console.log("initialized announcement model");
  },
  defaults: {
    id: null,
    file_location: null,
    caption: "Sample Title",
    file: null,
    filename: null,
    extension: null
    // category_id: null
  }
});
