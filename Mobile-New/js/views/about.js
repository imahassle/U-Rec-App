//View
app.views.facility = Backbone.View.extend({
	template: _.template($("#facility").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
		this.$el.html(this.template({}));
	}
});