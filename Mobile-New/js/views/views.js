var updateRender = function(that) {
	console.log("fetching new content...");
	that.collection.fetch();
};

var announcementView = Backbone.View.extend({
	template: _.template($("#announcementTemplate").html()),
	collection: new Backbone.Collection(),
	initialize: function() {
		this.$el.html($("#loading").html());
		this.collection = new app.collections.generalAnnouncement;
		this.collection.url = this.options.url;
		console.log("fetching from " + this.options.fetchURL);
		var that = this;
		that.collection.fetch().done(function() {
			console.log("fetched!");
		});
		this.collection.on("change sync", this.render, this);
		setInterval(function() {updateRender(that);}, 1000*60*5);
	},
	render: function() {
		console.log("Updating...");
		this.$el.html(this.template({collection: this.collection.toJSON()}));
		return this;
	}
});

var imageView = Backbone.View.extend({
	template: _.template($("#imageTemplate").html()),
	initialize: function() {
		this.$el.html($("#loading").html());
		this.collection = new app.collections.generalImage;
		this.collection.url = this.options.url;
		var that = this;
		console.log("taking pictures...");
		this.collection.fetch().done(function() {
			// that.render();
			console.log("snapped!");
		});
		this.collection.on("change sync", this.render, this);
		setInterval(function() {updateRender(that);}, 1000*60*5);
	},
	render: function() {
		console.log("imaging...");
		this.$el.html(this.template({collection: this.collection.toJSON()}));
		return this;
	}
});

var eventView = Backbone.View.extend({
	template: _.template($("#eventTemplate").html()),
	initialize: function() {
		this.$el.html($("#loading").html());
		this.collection = new app.collections.generalEvent;
		this.collection.url = this.options.url;
		var that = this;
		console.log("eventing events...");
		this.collection.fetch().done(function() {
			// that.render();
			console.log("evented!");
		});
		this.collection.on("change sync", this.render, this);
		setInterval(function() {updateRender(that);}, 1000*60*5);
	},
	render: function() {
		console.log("events...");
		this.$el.html(this.template({collection: this.collection.toJSON()}));
		return this;
	}
});

var rentalView = Backbone.View.extend({
	template: _.template($("#rentalTemplate").html()),
	initialize: function() {
		this.$el.html($("#loading").html());
		this.collection = new app.collections.generalEvent;
		this.collection.url = this.options.url;
		var that = this;
		console.log("renting view...");
		this.collection.fetch().done(function() {
			// that.render();
			console.log("rented!");
		});
		this.collection.on("change sync", this.render, this);
		// setInterval(function() {updateRender(that);}, 1000*60*5);
	},
	render: function() {
		console.log("rentals...");
		this.$el.html(this.template({collection: this.collection.toJSON()}));
		return this;
	}
});

var homeView = Backbone.View.extend({
	template: _.template($("#homeTemplate").html()),
	initialize: function() {
		this.$el.html($("#loading").html());
		this.collection = new app.collections.generalHome;
		this.collection.url = this.options.url;
		this.subTemplate = this.options.sub;
		this.titleName = this.options.name;
		var that = this;
		console.log("loading homepage...");
		this.collection.fetch().done(function() {
			// that.render();
			console.log("loaded!");
		});
		this.collection.on("change sync", this.render, this);
		setInterval(function() {updateRender(that);}, 1000*60*30);
	},
	render: function() {
		console.log("homepage...");
		this.$el.html(this.template({collection: this.collection.toJSON(), menu: this.subTemplate.html(), name: this.titleName, toggleHours: this.options.toggle}));
		return this;
	}
});
