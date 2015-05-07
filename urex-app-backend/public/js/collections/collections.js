var compare = function(a,b) {
  if(a.id < b.id) {
    return 1;
  }
  if(a.id > b.id) {
    return -1;
  }
  return 0;
};

app.collections.generalAnnouncement = Backbone.Collection.extend({
  model: Announcement,
  url: "api/announcement",
  comparator: compare,
});

app.collections.generalImage = Backbone.Collection.extend({
  model: Image,
  url: "api/image",
  comparator: compare,
});

app.collections.generalProgram = Backbone.Collection.extend({
  model: Program,
  url: "api/incentive_program",
  comparator: compare,
});

app.collections.generalEvent = Backbone.Collection.extend({
  model: Event,
  url: "api/event",
  comparator: compare,
});

app.collections.generalHome = Backbone.Collection.extend({
  model: Hours,
  url: "api/hours",
  comparator: compare,
})
