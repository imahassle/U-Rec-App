var announcementView = Backbone.View.extend({
	// template: _.template($("#insert").html()),
	// fetchURL: "../urex-app-backend/public/api/announcement/category/2",
	initialize: function() {
		this.el = this.options.el;
		this.collection = new app.collections.generalAnnouncement;
		this.collection.url = this.options.fetchURL;
		this.template = this.options.template;
		console.log("fetching from " + this.options.fetchURL);
		// console.log(that);
		var that = this;
		that.collection.fetch().done(function() {
			that.render();
			console.log("fetched!");
			// that.listenTo(that.collection, 'add remove sync', that.render);
			that.collection.listenTo(that.collection, "remove sync reset add change", function() {
				console.log("changed...");
				that.render();
			});
		});
	},
	render: function() {
		console.log("Updating...");
		// console.log(this.template());
		this.$el.html(this.template({collection: this.collection.toJSON()}));
		return this;
	}
});

// app.views.outdoorrecHome = new announcementView({
// 	el: this.content,
// 	fetchURL: "../urex-app-backend/public/api/announcement/category/2",
// 	template: _.template($("#insert").html())
// });

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
