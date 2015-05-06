//View
app.views.rentals = Backbone.View.extend({
	template: _.template($("#rentals").html()),
	initialize: function() {
		// _.bindAll(this, "render");
		// this.collection.bind("reset", this.render);
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});