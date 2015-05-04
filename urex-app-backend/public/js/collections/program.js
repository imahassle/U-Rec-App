app.collections.program = Backbone.Collection.extend({
  model: Program,
  url: "api/incentive_program",
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
