app.collections.facilityAnnouncement = Backbone.Collection.extend({
  model: Announcement,
  url: "api/announcement",
});

// var facilityAnnouncements = new app.collections.facilityAnnouncement;
