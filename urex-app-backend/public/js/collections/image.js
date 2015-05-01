app.collections.generalImage = Backbone.Collection.extend({
  model: Image,
  url: "api/image",
  comparator: function(a,b) {
    if(a.id < b.id) {
      return 1;
    }
    if(a.id > b.id) {
      return -1;
    }
    return 0;
  },
});
