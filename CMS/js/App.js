//App.js
var app = (function() {

	var api = {
		views: {},
		models: {},
		collections: {},
		content: null,
		router: null,
		cms: null,
		init: function() {
			this.content = $("#main"); //Sets initial view for app
			ViewsFactory.menu();
			this.rentalInfo = new TempRentals();
			// this.rentalInfo.fetch();
			// this.rentalInfo.bind('reset', function() {console.log(this.rentalInfo);});
			Backbone.history.start();
			return this;
		},
		changeContent: function(el) {
			this.content.empty().append(el);
			return this;
		}
	};
	var ViewsFactory = {
		menu: function() {
			if(!this.menuView) {
				this.menuView = new api.views.menu({ 
					el: $("#menu") 
				});
			}
			return this.menuView;
		},
		cms: function() {
			if(!this.cmsView) {
				this.cmsView = new api.views.cms({ 
					el: this.content
				});
			}
			return this.cmsView;
		},
		facility: function() {
			if(!this.aboutView) {
				this.aboutView = new api.views.facility({ 
					el: this.content
				});
			}
			return this.aboutView;
		},
		login: function() {
			if(!this.loginView) {
				this.loginView = new api.views.login({ 
					el: this.content
				});
			}
			return this.loginView;
		},
		stats: function() {
			if(!this.statsView) {
				this.statsView = new api.views.stats({ 
					el: this.content
				});
			}
			return this.statsView;
		},
		rentals: function() {
			if(!this.rentalsView) {
				this.rentalsView = new api.views.rentals({ 
					collection: api.rentalInfo
				});
			}
			
			return this.rentalsView;
		}
	};
	var Router = Backbone.Router.extend({
		routes: {
			"facility": "facility",
			"outdoorrec": "outdoorrec",
			"intramurals": "intramurals",
			"climbingwall": "climbingwall",
			"rentals": "rentals",
			"stats": "stats",
			"": "home",
			"login": "login"
		},
		home: function() {
			api.changeContent(ViewsFactory.cms().$el);
		},
		facility: function() {
			// alert("Hit about");
			api.changeContent(ViewsFactory.facility().$el);
			// ViewsFactory.about.render();
		},
		outdoorrec: function() {},
		intramurals: function() {},
		climbingwall: function() {},
		rentals: function() {
			api.changeContent(ViewsFactory.rentals().$el);
			api.rentalInfo.fetch({reset: "true"});
		},
		stats: function() {},
		login: function(valid) {
			api.changeContent(ViewsFactory.login().verify(valid).$el);
		}
	});
	api.router = new Router();

	return api;

})();