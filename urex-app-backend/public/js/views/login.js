app.views.login = Backbone.View.extend({
	template: _.template($("#login").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});
