app.views.stats = Backbone.View.extend({
	template: _.template($("#stats").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
		this.$el.html(this.template({}));
	}
});