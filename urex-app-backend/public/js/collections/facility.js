app.collections.generalAnnouncement = Backbone.Collection.extend({
  model: Announcement,
  url: "api/announcement",
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

// var facilityAnnouncements = new app.collections.facilityAnnouncement;
