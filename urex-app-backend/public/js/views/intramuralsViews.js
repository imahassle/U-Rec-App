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
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});