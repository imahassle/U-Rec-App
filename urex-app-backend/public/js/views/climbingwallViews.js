app.views.climbingwallHome = Backbone.View.extend({
	template: _.template($("#climbingwallHome").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.climbingwallHours = Backbone.View.extend({
	template: _.template($("#climbingwallHours").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.climbingwallPhotos = Backbone.View.extend({
	template: _.template($("#climbingwallPhotos").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.climbingwallEvents = Backbone.View.extend({
	template: _.template($("#climbingwallEvents").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});