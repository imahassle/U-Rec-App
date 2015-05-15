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
		this.collection = new app.collections.generalImage;
		this.collection.url = "api/image/category/4";
		var that = this;
		console.log("taking pictures...");
		this.collection.fetch().done(function() {
			that.render();
			console.log("snapped!");
			// that.listenTo(that.collection, 'add remove sync', that.render);
			that.listenTo(that.collection, "remove sync reset add change", function() {
				console.log("images changed...");
				that.render();
			});
		});
	},
	render: function() {
		console.log("imaging...");
		this.$el.html(this.template({collection: this.collection.toJSON()}));
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
