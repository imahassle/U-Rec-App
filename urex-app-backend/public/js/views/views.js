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
		// this.$el.html($("#loading").html());
		this.collection = new app.collections.generalImage;
		this.collection.url = "api/image/category/" + this.options.category;
		this.collectionName = this.options.collectionName;
		var that = this;
		console.log("taking pictures...");
		this.collection.fetch().done(function() {
			// that.render();
			console.log("snapped!");
		});
		this.collection.on("sync add change remove", this.render, this);
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
		// this.$el.html($("#loading").html());
		this.collection = new app.collections.generalEvent;
		this.collection.url = "api/event/category/"+this.options.category;
		this.collectionName =  this.options.collectionName;
		var that = this;
		console.log("eventing events...");
		that.collection.on("sync change remove", that.render, that);
		this.collection.fetch().done(function() {
			// that.render();
			console.log("evented!");

		});
	},
	render: function() {
		console.log("events...");
		this.$el.html(this.template({collection: this.collection.toJSON(), name: this.options.name, coll: this.collectionName, category: this.options.category}));
		return this;
	}
});

var programView = Backbone.View.extend({
	template: _.template($("#programTemplate").html()),
	initialize: function() {
		// this.$el.html($("#loading").html());
		this.collection = new app.collections.generalProgram;
		this.collection.url = "api/incentive_program";
		this.collectionName =  this.options.collectionName;
		var that = this;
		console.log("eventing events...");
		that.collection.on("sync change remove", that.render, that);
		this.collection.fetch().done(function() {
			// that.render();
			console.log("evented!");

		});
	},
	render: function() {
		console.log("events...");
		this.$el.html(this.template({collection: this.collection.toJSON(), name: this.options.name, coll: this.collectionName, category: this.options.category}));
		return this;
	}
});

var tripView = Backbone.View.extend({
	template: _.template($("#tripTemplate").html()),
	initialize: function() {
		// this.$el.html($("#loading").html());
		this.collection = new app.collections.generalProgram;
		this.collection.url = "api/event";
		this.collectionName =  this.options.collectionName;
		var that = this;
		console.log("eventing events...");
		that.collection.on("sync change remove", that.render, that);
		this.collection.fetch().done(function() {
			// that.render();
			console.log("evented!");

		});
	},
	render: function() {
		console.log("events...");
		this.$el.html(this.template({collection: this.collection.toJSON(), name: this.options.name, coll: this.collectionName, category: this.options.category}));
		return this;
	}
});

var rentalView = Backbone.View.extend({
	template: _.template($("#rentalTemplate").html()),
	initialize: function() {
		// this.$el.html($("#loading").html());
		this.collection = new app.collections.generalEvent;
		this.collection.url = "api/item_rental";
		var that = this;
		console.log("renting view...");
		this.collection.fetch().done(function() {
			that.render();
			console.log("rented!");
			that.collection.on("sync change remove", that.render, that);

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
		// this.$el.html($("#loading").html());
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

var feedbackView = Backbone.View.extend({
	template: _.template($("#facilityFeedback").html()),
	initialize: function() {
		// this.$el.html($("#loading").html());
		this.collection = new app.collections.generalAnnouncement;
		this.collection.url = "api/feedback";
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
		console.log("feedback...");
		this.$el.html(this.template({collection: this.collection, coll: this.collectionName}));
		return this;
	}
});

var hoursView = Backbone.View.extend({
	template: _.template($("#hoursTemplate").html()),
	initialize: function() {
		// this.$el.html($("#loading").html());
		this.collection = new app.collections.generalHour;
		this.category = this.options.category;
		this.collection.url = "api/hour/category/"+this.category;
		this.titleName = this.options.name;
		this.collectionName = this.options.collectionName;
		this.exceptionsCollection = new app.collections.generalHour;
		this.exceptionsCollection.url = "api/hour_exceptions/category"+this.category;
		this.exceptionsCollectionName = this.options.exceptionsCollectionName;
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
		this.$el.html(this.template({collection: this.collection.toJSON(), exceptionsCollection: this.exceptionsCollection.toJSON(), exColl: this.exceptionsCollectionName, category: this.category, name: this.titleName, coll: this.collectionName}));
		return this;
	}
});
