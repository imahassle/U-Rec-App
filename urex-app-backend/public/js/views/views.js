var menuView = Backbone.View.extend({
	template: _.template($("#cms-menu").html()),
	initialize: function() {
		this.el = this.options.el;
		this.render();
	},
	render: function() {
		this.$el.html(this.template({permissions: this.options.permissions}));
		return this;
	}
});

var loginView = Backbone.View.extend({
	template: _.template($("#login").html()),
	initialize: function() {
		this.render();
	},
	render: function() {
	this.$el.html(this.template({}));
		return this;
	}
});


var imageView = Backbone.View.extend({
	template: _.template($("#imageTemplate").html()),
	initialize: function() {
		this.$el.html($("#loading").html());
		this.collection = new app.collections.generalImage;
		this.collection.url = "api/image/category/" + this.options.category;
		this.collectionName = this.options.collectionName;
		var that = this;
		console.log("taking pictures...");
		this.collection.fetch().done(function() {
			that.render();
			console.log("snapped!");
		});
	},
	render: function() {
		console.log("imaging...");
		this.$el.html(this.template({collection: this.collection, cat: this.options.category, name: this.options.name, coll: this.collectionName}));
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

var rentalView = Backbone.View.extend({
	template: _.template($("#rentalTemplate").html()),
	initialize: function() {
		this.$el.html($("#loading").html());
		this.collection = new app.collections.generalEvent;
		this.collection.url = this.options.url;
		var that = this;
		console.log("renting view...");
		this.collection.fetch().done(function() {
			that.render();
			console.log("rented!");
		});
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
		this.collection = new app.collections.generalAnnouncement;
		this.category = this.options.category;
		this.collection.url = "api/announcement/category/"+this.category;
		this.subTemplate = this.options.sub;
		this.titleName = this.options.name;
		this.collectionName = this.options.collectionName;
		var that = this;
		console.log("loading homepage...");
		this.collection.fetch().done(function() {
			that.render();
			console.log("loaded!");
			that.collection.listenTo(that.collection, "remove sync reset add change", function() {
				console.log("changed...");
				that.render();
			});
		});
	},
	render: function() {
		console.log("homepage...");
		this.$el.html(this.template({collection: this.collection.toJSON(), category: this.category, menu: this.subTemplate.html(), name: this.titleName, coll: this.collectionName}));
		return this;
	}
});
