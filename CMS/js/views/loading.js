app.views.load = Backbone.View.extend({
	template: _.template($("#loading").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
		this.$el.html(this.template({}));
	}
});