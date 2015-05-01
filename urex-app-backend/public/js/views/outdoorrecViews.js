app.views.outdoorrecHome = Backbone.View.extend({
	template: _.template($("#outdoorrecHome").html()),
	initialize: function() {
		this.collection = new app.collections.generalAnnouncement;
		this.collection.url = "api/announcement/category/2";
		console.log("fetching...");
		var that = this;
		this.collection.fetch().done(function() {
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
		this.$el.html(this.template({collection: this.collection.toJSON()}));
		return this;
	}
});

app.views.outdoorrecTrips = Backbone.View.extend({
	template: _.template($("#outdoorrecTrips").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.outdoorrecPhotos = Backbone.View.extend({
	template: _.template($("#outdoorrecPhotos").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});
