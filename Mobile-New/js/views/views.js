var announcementView = Backbone.View.extend({
	template: _.template($("#announcementTemplate").html()),
	initialize: function() {
		this.$el.html($("#loading").html());
		this.collection = new app.collections.generalAnnouncement;
		this.collection.url = this.options.url;
		console.log("fetching from " + this.options.fetchURL);
		var that = this;
		// this.render();
		that.collection.fetch().done(function() {
			// that.render();
			// that.$el.html("</h1>HELLO WORLD</h1>");
			console.log("fetched!");
		});

		this.collection.on("sync", this.render, this);
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
			that.render();
			console.log("snapped!");
		});
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
			that.render();
			console.log("evented!");
		});
	},
	render: function() {
		console.log("events...");
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
			that.render();
			console.log("loaded!");
		});
	},
	render: function() {
		console.log("homepage...");
		this.$el.html(this.template({collection: this.collection.toJSON(), menu: this.subTemplate.html(), name: this.titleName}));
		return this;
	}
});
