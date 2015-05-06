app.views.intramuralsHome = Backbone.View.extend({
	template: _.template($("#intramuralsHome").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.intramuralsPhotos = Backbone.View.extend({
	template: _.template($("#intramuralsPhotos").html()),
	initialize: function() {
		this.collection = new app.collections.generalImage;
		this.collection.url = "api/image/category/3";
		var that = this;
		console.log("taking pictures...");
		this.collection.fetch().done(function() {
			that.render();
			console.log("snapped!");
			// that.listenTo(that.collection, 'add remove sync', that.render);
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
