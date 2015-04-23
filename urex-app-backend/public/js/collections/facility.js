app.collections.facilityAnnouncement = Backbone.Collection.extend({
  model: app.models.announcement,
  url: "api/announcement",
});
