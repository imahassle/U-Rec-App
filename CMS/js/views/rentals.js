app.views.rentals = Backbone.View.extend({
	template: _.template($("#rentals").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
		this.$el.html(this.template({}));
	}
});