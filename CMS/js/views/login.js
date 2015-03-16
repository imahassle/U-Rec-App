app.views.login = Backbone.View.extend({
	valid: null,
	template: _.template($("#login-prompt").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
		this.$el.html(this.template({
			valid: this.valid === "" ? "yes" : "hidden"
		}));
	},
	verify: function(valid) {
		this.valid = valid;
		return this;
	}
});