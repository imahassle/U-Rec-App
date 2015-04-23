app.views.outdoorrecHome = Backbone.View.extend({
	template: _.template($("#outdoorrecHome").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
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