//App.js
var app = (function() {

	var api = {
		views: {},
		models: {},
		collections: {},
		content: null,
		router: null,
		cms: null,
		viewsFactory: null,
		init: function() {
			this.content = $("#main"); //Sets initial view for app
			if($.cookie('U-Rex-API-Key')) {
				ViewsFactory.menu();
			}

			// this.rentalInfo = new TempRentals();
			// this.rentalInfo.fetch();
			// this.rentalInfo.bind('reset', function() {console.log(this.rentalInfo);});
			$.ajaxSetup({
				headers: { 'X-Authorization' : $.cookie('U-Rex-API-Key')}
			});

			Backbone.history.start();
			return this;
		},
		changeContent: function(el) {
			this.content.empty().append(el);
			return this;
		}
	};
	var ViewsFactory = {
		login: function() {
			if(!this.loginView) {
				this.loginView = new api.views.login({
					el: this.content
				});
			}
			return this.loginView;
		},
		menu: function() {
			if(!this.menuView) {
				this.menuView = new api.views.menu({
					el: $("#menu")
				});
			}
			return this.menuView;
		},
		removeMenu: function() {
			$("#menu").html("");
			this.menuView = null;
			return this.menuView;
		},
		facilityHome: function() {
			if(!this.facilityHomeView) {
				this.facilityHomeView = new api.views.facilityHome({
					el: this.content
				});
				// this.facilityHomeView.render();
			}
			return this.facilityHomeView;
		},
		facilityHours: function() {
			if(!this.facilityHoursView) {
				this.facilityHoursView = new api.views.facilityHours({
					el: this.content
				});
			}
			return this.facilityHoursView;
		},
		facilityProg: function() {
			if(!this.facilityProgView) {
				this.facilityProgView = new api.views.facilityProg({
					el: this.content
				});
			}
			return this.facilityProgView;
		},
		facilityEvents: function() {
			if(!this.facilityEventsView) {
				this.facilityEventsView = new api.views.facilityEvents({
					el: this.content
				});
			}
			return this.facilityEventsView;
		},
		facilityPhotos: function() {
			if(!this.facilityPhotosView) {
				this.facilityPhotosView = new api.views.facilityPhotos({
					el: this.content
				});
			}
			return this.facilityPhotosView;
		},
		facilityFeedback: function() {
			if(!this.facilityFeedbackView) {
				this.facilityFeedbackView = new api.views.facilityFeedback({
					el: this.content
				});
			}
			return this.facilityFeedbackView;
		},
		outdoorrecHome: function() {
			if(!this.outdoorrecHomeView) {
				this.outdoorrecHomeView = new api.views.outdoorrecHome({
					el: this.content
				});
			}
			return this.outdoorrecHomeView;
		},
		outdoorrecTrips: function() {
			if(!this.outdoorrecTripsView) {
				this.outdoorrecTripsView = new api.views.outdoorrecTrips({
					el: this.content
				});
			}
			return this.outdoorrecTripsView;
		},
		outdoorrecPhotos: function() {
			if(!this.outdoorrecPhotosView) {
				this.outdoorrecPhotosView = new api.views.outdoorrecPhotos({
					el: this.content
				});
			}
			return this.outdoorrecPhotosView;
		},
		intramuralsHome: function() {
			if(!this.intramuralsHomeHome) {
				this.intramuralsHomeHome = new api.views.intramuralsHome({
					el: this.content
				});
			}
			return this.intramuralsHomeHome;
		},
		intramuralsPhotos: function() {
			if(!this.intramuralsPhotosView) {
				this.intramuralsPhotosView = new api.views.intramuralsPhotos({
					el: this.content
				});
			}
			return this.intramuralsPhotosView;
		},
		climbingwallHome: function() {
			if(!this.climbingwallHomeView) {
				this.climbingwallHomeView = new api.views.climbingwallHome({
					el: this.content
				});
			}
			return this.climbingwallHomeView;
		},
		climbingwallHours: function() {
			if(!this.climbingwallHoursView) {
				this.climbingwallHoursView = new api.views.climbingwallHours({
					el: this.content
				});
			}
			return this.climbingwallHoursView;
		},
		climbingwallPhotos: function() {
			if(!this.climbingwallPhotosView) {
				this.climbingwallPhotosView = new api.views.climbingwallPhotos({
					el: this.content
				});
			}
			return this.climbingwallPhotosView;
		},
		climbingwallEvents: function() {
			if(!this.climingwallEventsView) {
				this.climingwallEventsView = new api.views.climbingwallEvents({
					el: this.content
				});
			}
			return this.climingwallEventsView;
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

	api.viewsFactory = ViewsFactory;

	// api.facilityView = ViewsFactory.facilityHome();

	var Router = Backbone.Router.extend({
		routes: {
			"facility": "facilityHome",
			"facility/hours": "facilityHours",
			"facility/programs": "facilityProg",
			"facility/events": "facilityEvents",
			"facility/photos": "facilityPhotos",
			"facility/feedback": "facilityFeedback",
			"facility/remove/:id": "facilityRemove",
			"outdoorrec": "outdoorrecHome",
			"outdoorrec/trips": "outdoorrecTrips",
			"outdoorrec/photos": "outdoorrecPhotos",
			"intramurals": "intramuralsHome",
			"intramurals/photos": "intramuralsPhotos",
			"climbingwall": "climbingwallHome",
			"climbingwall/hours": "climbingwallHours",
			"climbingwall/photos": "climbingwallPhotos",
			"climbingwall/events": "climbingwallEvents",
			"rentals": "rentals",
			"stats": "stats",
			"": "home",
			"login": "login"
		},
		home: function() {
			api.changeContent(ViewsFactory.login().$el);
		},
		facilityHome: function() {
			api.changeContent(ViewsFactory.facilityHome().$el);
		},
		facilityHours: function() {
			// alert("Hit about");
			api.changeContent(ViewsFactory.facilityHours().$el);
			// ViewsFactory.about.render();
		},
		facilityProg: function() {
			api.changeContent(ViewsFactory.facilityProg().$el);
		},
		facilityEvents: function() {
			api.changeContent(ViewsFactory.facilityEvents().$el);
		},
		facilityPhotos: function() {
			api.changeContent(ViewsFactory.facilityPhotos().$el);
		},
		facilityFeedback: function() {
			api.changeContent(ViewsFactory.facilityFeedback().$el);
		},
		outdoorrecHome: function() {
			api.changeContent(ViewsFactory.outdoorrecHome().$el);
		},
		outdoorrecTrips: function() {
			api.changeContent(ViewsFactory.outdoorrecTrips().$el);
		},
		outdoorrecPhotos: function() {
			api.changeContent(ViewsFactory.outdoorrecPhotos().$el);
		},
		intramuralsHome: function() {
			api.changeContent(ViewsFactory.intramuralsHome().$el);
		},
		intramuralsPhotos: function() {
			api.changeContent(ViewsFactory.intramuralsPhotos().$el);
		},
		climbingwallHome: function() {
			api.changeContent(ViewsFactory.climbingwallHome().$el);
		},
		climbingwallHours: function() {
			api.changeContent(ViewsFactory.climbingwallHours().$el);
		},
		climbingwallPhotos: function() {
			api.changeContent(ViewsFactory.climbingwallPhotos().$el);
		},
		climbingwallEvents: function() {
			api.changeContent(ViewsFactory.climbingwallEvents().$el);
		},
		rentals: function() {
			api.changeContent(ViewsFactory.rentals().$el);
			// api.rentalInfo.fetch({reset: "true"});
		},
		stats: function() {},
		login: function(valid) {
			api.changeContent(ViewsFactory.login().$el);
		},
		facilityRemove: function(id) {

			console.log("removing ", id);
			api.viewsFactory.facilityHome().collection.get(id).destroy();
			this.navigate("#facility");
		}
	});
	api.router = new Router();

	return api;

})();
