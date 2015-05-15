var compare = function(a,b) {
  if(a.id < b.id) {
    return 1;
  }
  if(a.id > b.id) {
    return -1;
  }
  return 0;
};

var compareDate = function(a, b) {
  if(a.day_of_week < b.day_of_week) {
    return 1;
  }
  if(a.day_of_week > b.day_of_week) {
    return -1;
  }
  return 0;
};

app.collections.users = Backbone.Collection.extend({
  model: User,
  url: "api/user",
  comparator: compare,
});

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

app.collections.generalHour = Backbone.Collection.extend({
  model: Hours,
  url: "api/hours",
  comparator: compareDate
});
