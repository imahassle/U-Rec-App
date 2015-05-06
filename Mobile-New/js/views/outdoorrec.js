var announcementView = Backbone.View.extend({
	initialize: function() {
		this.el = this.options.el;
		this.collection = new app.collections.generalAnnouncement;
		this.collection.url = this.options.fetchURL;
		this.template = this.options.template;
		console.log("fetching from " + this.options.fetchURL);
		var that = this;
		that.collection.fetch().done(function() {
			that.render();
			console.log("fetched!");
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

var imageView = Backbone.View.extend({
	// template: _.template($("#outdoorrecPhotos").html()),
	initialize: function() {
		this.collection = new app.collections.generalImage;
		this.collection.url = this.options.url;
		this.template = this.options.template;
		var that = this;
		console.log("taking pictures...");
		this.collection.fetch().done(function() {
			that.render();
			console.log("snapped!");
			that.listenTo(that.collection, "remove sync reset add change", function() {
				console.log("images changed...");
				that.render();
			});
		});
	},
	render: function() {
		console.log("imaging...");
		this.$el.html(this.template({collection: this.collection.toJSON()}));
		return this;
	}
});
