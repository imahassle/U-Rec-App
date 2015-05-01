app.views.facilityHome = Backbone.View.extend({
	template: _.template($("#facilityHome").html()),
	// subtemplate: _.template($("#announcement_home").html()),
	filler: "",
	initialize: function() {
		this.collection = new app.collections.facilityAnnouncement;
		console.log("fetching...");
		var that = this;
		this.collection.fetch().done(function() {
			that.render();
			console.log("fetched!");
			// that.listenTo(that.collection, 'add remove sync', that.render);
			that.collection.listenTo(that.collection, "remove sync reset add change", function() {
				console.log("changed...");
				that.render();
			});
		});

		// this.collection.on('change reset add remove', this.render, this);

	},
	render: function() {

	console.log("Updating...");
	this.$el.html(this.template());
	
	return this;

	}
});

app.views.facilityHours = Backbone.View.extend({
	template: _.template($("#facilityHours").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.facilityProg = Backbone.View.extend({
	template: _.template($("#facilityProg").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.facilityEvents = Backbone.View.extend({
	template: _.template($("#facilityEvents").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.facilityPhotos = Backbone.View.extend({
	template: _.template($("#facilityPhotos").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});

app.views.facilityFeedback = Backbone.View.extend({
	template: _.template($("#facilityFeedback").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});
