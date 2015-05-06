var announcementInit = function(url, that) {
	that.collection = new app.collections.generalAnnouncement;
	that.collection.url = url;
	console.log("fetching...");
	// var that = this;
	that.collection.fetch().done(function() {
		that.render();
		console.log("fetched!");
		// that.listenTo(that.collection, 'add remove sync', that.render);
		that.collection.listenTo(that.collection, "remove sync reset add change", function() {
			console.log("changed...");
			that.render();
		});
	});
};

var renderFunc = function(that) {
	console.log("Updating...");
	that.$el.html(that.template());
	return that;
};

app.views.outdoorrecHome = Backbone.View.extend({
	template: _.template($("#outdoorrecAnnouncements").html()),
	// collection: new app.collections.generalAnnouncement,
	initialize: announcementInit("api/announcement/category/2", this),
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

// app.views.outdoorrecTrips = Backbone.View.extend({
// 	template: _.template($("#outdoorrecTrips").html()),
// 	initialize: function() {
// 		this.render();
// 	},
// 	render: function() {
// 	this.$el.html(this.template({}));
// 		return this;
// 	}
// });
//
// app.views.outdoorrecPhotos = Backbone.View.extend({
// 	template: _.template($("#outdoorrecPhotos").html()),
// 	initialize: function() {
// 		this.collection = new app.collections.generalImage;
// 		this.collection.url = "api/image/category/2";
// 		var that = this;
// 		console.log("taking pictures...");
// 		this.collection.fetch().done(function() {
// 			that.render();
// 			console.log("snapped!");
// 			// that.listenTo(that.collection, 'add remove sync', that.render);
// 			that.listenTo(that.collection, "remove sync reset add change", function() {
// 				console.log("images changed...");
// 				that.render();
// 			});
// 		});
// 	},
// 	render: function() {
// 		console.log("imaging...");
// 		this.$el.html(this.template({collection: this.collection.toJSON()}));
// 		return this;
// 	}
// });
