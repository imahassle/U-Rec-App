app.collections.facilityAnnouncement = Backbone.Collection.extend({
  initialize: function() {

  },
  default: {
    collection: app.models.announcement
  },
  model: app.models.announcement,
  url: "resources/announcements.json",
  parse: function(response) {
    return response;
  }
})
