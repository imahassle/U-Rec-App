app.views.insertName = Backbone.View.extend({
	template: _.template($("#dummy").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});